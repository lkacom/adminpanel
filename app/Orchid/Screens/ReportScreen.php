<?php

namespace App\Orchid\Screens;

use App\Models\Invoice;
use App\Models\Report;
use App\Models\User;
use App\Orchid\Layouts\ReportChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Sight;
use App\Orchid\Resources\ClientResource;


class ReportScreen extends Screen
{


    public function query(): iterable
    {

        $account = Invoice::query()->get();
        $data = User::filters()->defaultSort('id')->paginate();
        $today = Report::query()->whereDate('created_at', today())->get();

        //Chart query for Report Page
        $orders = [];
        $free = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $orders[] = Report::whereDate('created_at', $date)->count();
            $free[] = Report::select('id', $date)->count();
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

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Reports';
    }
    public function description(): ?string
    {
        return 'View Report Report and Sales';
    }


    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
//            Link::make('Add New')
//                ->icon('arrow-right-circle')
//                ->href('http://127.0.0.1:8000/admin/crud/create/post-resources'), // نام روت مورد نظر را اینجا قرار دهید
//

        ];
    }


    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        $template = Layout::view('platform::dummy.block');



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
                                ->route('platform.systems.users.edit', $user->id);
                        }),
                    TD::make('email_verified_at','Verify Status')
                    ->render(fn (\Orchid\Platform\Models\User $user) => $user->email_verified_at === null
                        ? '<i class="text-danger">●</i> Not Verified'
                        : '<i class="text-success">●</i> Verified'),
                    TD::make('created_at','Register Date')->sort(),
                ]),




            ]),

            Layout::columns([
                ReportChart::make('charts', 'Line Chart')
                    ->description('Visualize data trends with multi-colored line graphs.'),
//                ChartBarExample::make('charts', 'Bar Chart')
//                    ->description('Compare data sets with colorful bar graphs.'),
            ]),
//            Layout::split([
//                $template,
//                $template,
//            ])->ratio('50/50'),
//            Layout::Blank([
//                $template3,
//
//            ]),


        ];
    }

    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }
}

