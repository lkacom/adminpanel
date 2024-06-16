<?php

namespace App\Orchid\Screens;

use App\Models\Account;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;
use LaravelQRCode\Facades\QRCode;
use Orchid\Support\Facades\Layout;

class MyserviceScreen extends Screen
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

        $myservice = Account::query()->where('user_id' , $userEmail)->filters()->defaultSort('id')->paginate(4);


        return [

            'table'   => ($myservice),


        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('My Service');
    }
    public function description(): ?string
    {
        return __('List Services and orders');
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


            Layout::columns([
                Layout::table('table', [
                    TD::make('id',__('ID'))
                        ->filter(Input::make())
                        ->sort(),
                    TD::make('user_id',__('Email'))
                        ->render(function (Account $invoice) {
                            return $invoice->accounts->email;
                        })
                        ->sort()
                        ->filter(Input::make()),
                    TD::make('name',__('Type'))
                        ->filter(Input::make())
                        ->sort(),
                    TD::make('expiration_date',__('Expire Date'))
                        ->filter(Input::make())
                        ->sort(),
                    TD::make('config',__('Config'))
                        ->render(function ($invoice) {
                            $path = public_path().'/qr-code.png';
                            $text = $invoice->config;
                            QRCode::text($invoice->config)->setOutfile($path)->setSize(2)->png();
                            $filename = '/qr-code.png';
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
