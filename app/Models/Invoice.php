<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;
use Str;

class Invoice extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess, Filterable;

    protected $table = 'invoices' ;

    protected $fillable = ['amount', 'user_id'];

    protected array $allowedSorts = [
        'id',
        'user_id',
        'status',
        'amount',
        'status',
        'created_at',
    ];

    protected array $allowedFilters = [
        'id'            => Like::class,
        'user_id'       => Like::class,
        'description'   => Like::class,
        'amount'        => Like::class,
        'status'        => Like::class,
        'created_at'    => WhereDateStartEnd::class,
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'invoice_id');
    }

    public function create($products)
    {
        $this->amount   = $this->calculateAmount($products);
        $this->user_id  = Auth::user()->id;
        $this->save();
        $products->each(function ($product) {
            $this->orders()->create([
                'invoice_id'    => $this->id,
                'user_id'       => Auth::user()->id,
                'product_id'    => $product->id,
                'uuid'          => Str::orderedUuid()
            ]);
        });
        return $this;
    }

    protected function calculateAmount($products){
        return $products->map(function ($product) {
            return $product->price;
        })->sum();
    }
}
