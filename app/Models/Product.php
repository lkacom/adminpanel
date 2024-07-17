<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess;

    protected $table = 'products' ;

    protected $fillable = [
        'name',
        'protocol_id',
        'server_id',
        'period_id'
    ];

    public function protocol()
    {
        return $this->belongsTo(Protocol::class,'protocol_id');
    }

    public function server()
    {
        return $this->belongsTo(Server::class,'server_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class,'period_id');
    }
}
