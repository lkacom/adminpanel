<?php

namespace App\Models;

use Request;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Period extends Model
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess;

    protected $table = 'periods' ;

    protected $fillable = ['duration'];

    protected function duration(): Attribute
    {
        return Attribute::make(
            get: function ($duration) {
                return $duration;
            },
            set: function ($duration) {
                $type = request()->get('model')['type'];
                switch ($type) {
                    case 'minute':
                        $duration = $duration * 60;
                        break;
                    case 'day':
                        $duration = $duration * 86400;
                        break;
                    case 'month':
                        $duration = $duration * 2592000;
                        break;
                    case 'year':
                        $duration = $duration * 31536000;
                        break;
                }
                return $duration;
            },
        );
    }

}
