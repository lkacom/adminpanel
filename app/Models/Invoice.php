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

class Invoice extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess, Filterable;

    protected $table = 'invoices' ;

    protected $fillable = ['amount', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected $allowedSorts = [
        'id',
        'user_id',
        'status',
        'amount',
        'status',
        'created_at',
    ];

    protected $allowedFilters = [
        'id'            => Like::class,
        'user_id'       => Like::class,
        'description'   => Like::class,
        'amount'        => Like::class,
        'status'        => Like::class,
        'created_at'    => WhereDateStartEnd::class,
    ];


}
