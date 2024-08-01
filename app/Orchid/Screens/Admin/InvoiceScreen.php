<?php

namespace App\Orchid\Screens\Admin;

use App\Models\Invoice;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class InvoiceScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['admin.invoices'];
    }

    public function name(): ?string
    {
        return __('Invoice Report');
    }

    public function description(): ?string
    {
        return __('History of Invoice Clients');
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function query(): iterable
    {
        $data =Invoice::filters()->defaultSort('id')->paginate(15);

        return [
            'table'   => ($data),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::columns([

                Layout::table('table', [

                    TD::make('id',__('ID'))
                        ->filter(Input::make())
                        ->sort(),
                    TD::make('user_id',__('Email'))
                        ->render(function (Invoice $invoice) {
                            return $invoice->user->email;
                        })
                        ->sort()
                        ->filter(Input::make()),
                    TD::make('amount',__('Amount'))
                        ->filter(Input::make())
                        ->sort()
                        ->filter(Input::make()),
                    TD::make('description',__('Description'))
                        ->filter(Input::make()),
                    TD::make('status',__('Status'))
                        ->sort()
                        ->filter(Input::make()),
                    TD::make('created_at',__('Date'))
                        ->sort()
                        ->filter(Input::make()),
                ]),
                Layout::rows([
                    Label::make('title')
                        ->title(__('Note: For Copy config to clipboard please click on QRCode ')),
                ]),
            ]),

        ];
    }
}
