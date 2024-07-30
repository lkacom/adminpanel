<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;


class Order extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess;

    protected $table = 'orders';

    protected $fillable = [
        'name',
        'trial',
        'product_id',
        'user_id',
    ];

    protected array $allowedSorts = [
        'id',
        'name',
        'description',
        'expiration_date',
    ];

    protected array $allowedFilters = [
        'id'                => Like::class,
        'name'              => Like::class,
        'description'       => Like::class,
        'expiration_date'   => Like::class,

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
