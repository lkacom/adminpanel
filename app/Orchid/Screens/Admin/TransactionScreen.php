<?php

namespace App\Orchid\Screens\Admin;

use App\Models\Transaction;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TransactionScreen extends Screen
{

    public function permission(): ?iterable
    {
        return ['admin.transactions'];
    }

    public function query(): iterable
    {
        return [
            'table'   => Transaction::filters()->defaultSort('id')->paginate(15),
        ];
    }

    public function name(): ?string
    {
        return 'Payment History';
    }

    public function description(): ?string
    {
        return 'History of Transactions of Clients';
    }

    public function commandBar(): iterable
    {
        return [];
    }

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
