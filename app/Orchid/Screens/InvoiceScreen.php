<?php

namespace App\Orchid\Screens;

use App\Models\Invoice;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class InvoiceScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['platform.admin'];
    }


    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $data =Invoice::filters()->defaultSort('id')->paginate(15);

        return [

            'table'   => ($data),


        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Invoice Report';
    }

    public function description(): ?string
    {
        return 'History of Invoice Clients';
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
                    TD::make('user_id','Email')
                        ->render(function (Invoice $invoice) {
                            return $invoice->users->email;
                        })
                        ->sort()
                        ->filter(Input::make()),
                    TD::make('amount','Amount')
                        ->filter(Input::make())
                        ->sort()
                        ->filter(Input::make()),
                    TD::make('description','Description')
                        ->filter(Input::make()),
                    TD::make('status','Status')
                        ->sort()
                        ->filter(Input::make()),
                    TD::make('created_at','Date')
                        ->sort()
                        ->filter(Input::make()),

                ]),




            ]),




        ];
    }
}
