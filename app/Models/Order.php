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
        'user_id',
        'uuid',
        'product_id'
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

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invoice(){
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id','product_id');
    }

}
