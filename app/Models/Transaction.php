<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Transaction extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess, Filterable;

    protected $table = 'transactions' ;

    protected $fillable = [
        'status',
        'amount',
        'invoice_id',
        'transaction_id',
        'tracking_cookie',
        'comment'
    ];

    protected array $allowedFilters = [
        'id'            => Like::class,
        'invoice_id'    => Like::class,
        'status'        => Like::class,
        'amount'        => Like::class,
        'comment'       => Like::class,
        'created_at'    => WhereDateStartEnd::class,
    ];

    protected array $allowedSorts = [
        'id',
        'invoice_id',
        'status',
        'amount',
        'transaction_id',
        'created_at',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class,'id','invoice_id');
    }
}
