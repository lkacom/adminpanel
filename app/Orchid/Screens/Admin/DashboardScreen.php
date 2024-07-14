<?php

namespace App\Orchid\Screens\Admin;

use App\Models\Invoice;
use App\Models\User;
use App\Orchid\Layouts\ReportChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;


class DashboardScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['admin.dashboard'];
    }

    public function query(): iterable
    {

        $account = Invoice::query()->get();
        $data = User::filters()->defaultSort('id')->paginate(10);
        $today = User::query()->whereDate('created_at', today())->get();

        //Chart query for dashboard Page
        $orders = [];
        $free = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $orders[] = User::whereDate('created_at', $date)->count();
            $free[] = User::select('id', $date)->count();
            $labels[] = $i == 0 ? 'Today' : ($i == 1 ? 'Yesterday' : "$i Days ago");
        }

        return [
            'charts' => [
                [
                    'name'   => 'order',
                    'values' => $orders,
                    'labels' => [$labels],
                ],
                [
                    'name'   => 'free',
                    'values' => $free,
                    'labels' => [$labels],
                    ],
            ],

            'table'   => ($data),

            'metrics' => [
                'sales'    => ['value' => $account->Where('description' , 'paid')->count()],
                'today'   => ['value' => $today->count()],
                'free'   => ['value' => $account->Where('description' , 'free')->count()],
                'account'    => $data->count(),

            ],
        ];
    }

    public function name(): ?string
    {
        return 'Dashboard';
    }
    public function description(): ?string
    {
        return 'View Report and Sales and ...';
    }

    public function commandBar(): iterable
    {
        return [

        ];
    }

    public function layout(): iterable
    {
        return [

            Layout::metrics([
                'Sales'    => 'metrics.sales',
                'Free Account' => 'metrics.free',
                'Today Register' => 'metrics.today',
                'Total Client' => 'metrics.account',
            ]),

            Layout::columns([
                Layout::table('table', [
                    TD::make('id','ID')->sort(),
                    TD::make('email')->sort()
                        ->render(function (User $user) {
                            return Link::make($user->email)
                                ->route('admin.users.edit', $user->id);
                        }),
                    TD::make('email_verified_at','Verify Status')
                    ->render(fn (\Orchid\Platform\Models\User $user) => $user->email_verified_at === null
                        ? '<i class="text-danger circle">Not Verified</i>'
                        : '<i class="text-success circle">Verified</i>'),
                    TD::make('created_at','Register Date')->sort(),
                ]),
            ]),

            Layout::columns([
                ReportChart::make('charts', 'Line Chart')
                    ->description('Visualize data trends with multi-colored line graphs.'),
            ]),
        ];
    }

    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }
}

