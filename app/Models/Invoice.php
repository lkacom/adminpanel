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

//    public function create(string $description,array $items)
//    {
//        $this->fireEvent('invoice.creating',collect($items));
//        $invoice = $this->createModel();
//        $invoice->description = $description;
//        $invoice->save();
//
//        $invoiceItems = new Items(config()->get('mirbaagheri.invoice.item.model'),app()->get('events'));
//        $invoiceItems->addToInvoice($invoice,$items);
//
//        $this->fireEvent('invoice.created',$invoice);
//
//        return $invoice;
//    }
}
