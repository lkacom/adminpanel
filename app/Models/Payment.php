<?php

namespace App\Models;

use App\Orchid\Filters\PaymentFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDate;
use Orchid\Filters\Types\WhereIn;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;
class Payment extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess;

    protected $table = 'transactions' ;

    protected $fillable = ['status', 'amount', 'invoice_id','transaction_id', 'comment'];



    public function paymentid()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }


    use Filterable;

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id'            => Like::class,
        'invoice_id'       => Like::class,
        'status'        => Like::class,
        'amount'       => Like::class,
        'comment'    => Like::class,
        'created_at'    => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'invoice_id',
        'status',
        'amount',
        'transaction_id',
        'created_at',
    ];



}
