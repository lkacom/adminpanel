<?php

namespace App\Orchid\Screens;

use App\Models\Account;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use LaravelQRCode\Facades\QRCode;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\ReportChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Sight;

class DashboardScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['platform.client'];
    }



    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

        $userEmail = Auth::id();

        $myservice = Account::query()->where('user_id' , $userEmail)->latest()->limit(1)->get();
        $account = Payment::query()->where('invoice_id' , $userEmail)->get();
        $paid = Invoice::query()->where('user_id' , $userEmail)->get();


        if ($myservice) {
        } else {

            echo "No record found.";
        }



        return [

            'table'   => ($myservice),


            'metrics' => [
                'paid'    => ['value' => $paid->Where('status' , '1')->count()],
                'active'   => ['value' => $account->count()],
                'expire'   => ['value' => $account->count()],

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
        return __('Dashboard');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {

        return [


            Layout::metrics([
                __('Paid Account')    => 'metrics.paid',
                __('Active Accounts') => 'metrics.active',
                __('Expired Account') => 'metrics.expire',
            ]),

            Layout::rows([
                Label::make('title')
                    ->title(__('For Copy config to clipboard please click on QRcode ')),
            ]),
            Layout::columns([
                Layout::table('table', [
                    TD::make('id',__('ID')),
                    TD::make('name',__('Type')),
                    TD::make('expiration_date',__('Expire Date')),
                    TD::make('config',__('Config'))
                        ->render(function ($invoice) {
                            $path = public_path().'/qr-code.png';
                            $text = $invoice->config;
                            QRCode::text($invoice->config)->setOutfile($path)->setSize(2)->png();
                            return '<img src="' . asset('qr-code.png') . '" onclick="copyToClipboard(\'' . $text . '\')" style="cursor: pointer;">';                        }),


                    TD::make('status',__('Status'))
                        ->render(fn (Account $user) => $user->expiration_date === null
                            ? '<i class="text-danger">●</i> Expired'
                            : '<i class="text-success">●</i> Active'),



                ]),




            ]),


        ];
    }
}
