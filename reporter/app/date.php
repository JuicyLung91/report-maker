<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class date extends Model
{
    //add Period - add one week every 7 days https://scotch.io/tutorials/easier-datetime-in-laravel-and-php-with-carbon
    //check if a days is already set
    //add new date 
    
    /**
     * create a period of dates - calls weeks after every 7 days
     * 
     * @param $startdate, $enddate
     *  
     */
    public static function createPeriod ($startdate, $enddate) {
        Carbon::setLocale('de');
        $dateFormat = 'd-m-Y';
        $startdate = Carbon::createFromFormat($dateFormat, $startdate);
        $enddate = Carbon::createFromFormat($dateFormat, $enddate);
        $currentdate = false;
        $period = array();
        $days = 1;
        while ($currentdate != $enddate) {
            $currentdate = $currentdate === false ? $startdate : $startdate->addDay();
            $period[] = Carbon::parse($currentdate->toDateString())->format($dateFormat);
            if ($days % 8 == 0 || $days == 1) {
                $weekStart = Carbon::parse($currentdate->toDateString())->format($dateFormat);
                $weekEnd = Carbon::createFromFormat($dateFormat, $weekStart)->addDays(6);
                $weekEnd = Carbon::parse($weekEnd->toDateString())->format($dateFormat);
                echo $days.' '.$weekStart.' '.$weekEnd.'<br>';
                //call week and add save
            }
            $days++;
        }
        //save days to database
        $date = new date;
        $date->saveDates($period);
        return $period;
    }

    /**
     * save dates to db
     * 
     * @param $dates array
     */
    protected function saveDates ($dates) {
        echo 'save';
    }
}
