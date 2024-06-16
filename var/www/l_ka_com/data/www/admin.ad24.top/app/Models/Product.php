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


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products' ;

    protected $fillable = ['VPN_Name', 'protocol_id', 'server_id', 'term_id'];

    public function protocol()
    {
        return $this->belongsTo(Protocol::class,'protocol_id');
    }

    public function server()
    {
        return $this->belongsTo(Server::class,'server_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class,'term_id');
    }



}
