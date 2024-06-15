<?php

namespace App\Orchid\Screens;

use App\Models\Payment;
use App\Orchid\Layouts\PaymentSelection;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Request;

class PaymentScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

        return [


            'table'   => Payment::filters()->defaultSort('id')->paginate(15),


        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Payment History';
    }

    public function description(): ?string
    {
        return 'History of Transactions of Clients';
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
                    TD::make('id','ID')
                        ->filter(Input::make())
                        ->sort(),
                    TD::make('invoice_id','Invoice ID')
                        ->filter(Input::make())
                        ->sort(),
                    TD::make('status','Status')
                        ->filter(Input::make())
                        ->sort(),
                    TD::make('amount','Amount')
                    ->filter(input::make())
                    ->sort(),
                    TD::make('transaction_id','Transaction ID')
                        ->filter(Input::make())
                        ->sort()
                        ->defaultHidden(),
                    TD::make('comment','Note')
                        ->filter(Input::make())
                        ->sort()
                        ->defaultHidden(),
                    TD::make('created_at','Date')
                        ->filter(Input::make())
                        ->sort(),

                ]),




            ]),




        ];
    }
}
