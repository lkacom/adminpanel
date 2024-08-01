<?php

namespace App\Models;

use Carbon\CarbonInterval;
use DateTime;
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
                //return $this->convertSecToTime($duration);
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

    public function convertSecToTime($sec){
        $date1 = new DateTime("@0"); //starting seconds
        $date2 = new DateTime("@$sec"); // ending seconds
        $interval =  date_diff($date1, $date2); //the time difference
        $timeArray = explode(',',$interval->format('%y Years,%m months,%d days,%h hours,%i minutes,%s seconds'));
        foreach ($timeArray as $key => $value) {
            if(str_starts_with($value,'0'))
                unset($timeArray[$key]);
        }
        return implode(', ',$timeArray);
    }

}
