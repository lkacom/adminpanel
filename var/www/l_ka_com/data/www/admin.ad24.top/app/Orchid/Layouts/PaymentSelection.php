<?php

namespace App\Orchid\Layouts;

use App\Orchid\Filters\PaymentFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class PaymentSelection extends Selection
{

    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [

            PaymentFilter::class,


        ];
    }
}
