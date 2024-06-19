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

class Account extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess;

    protected $table = 'orders';

    protected $fillable = ['name', 'trial', 'user_id'];

    public function accounts()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $allowedSorts = [
        'id',
        'name',
        'description',
        'expiration_date',
    ];

    use Filterable;

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id'            => Like::class,
        'name'       => Like::class,
        'description'        => Like::class,
        'expiration_date'       => Like::class,

    ];


}
