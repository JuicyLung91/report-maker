<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\weeks;

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
    public static function createPeriod ($startdate, $enddate, $schoolday) {
        setlocale(LC_TIME, 'German');
        $dateFormat = 'Y-m-d';
        $startdate = Carbon::createFromFormat($dateFormat, $startdate);
        $enddate = Carbon::createFromFormat($dateFormat, $enddate);
        $currentdate = false;
        $period = array();
        while ($currentdate != $enddate) {
            $currentdate = $currentdate === false ? $startdate : $startdate->addDay();
            $day = new Carbon;
            $day = $day->parse($currentdate)->toDateString();
            $period[] = $day;
        }
        // $date = new date;
        // $date->saveDates($period);
        foreach ($period as $singleDayKey => $singleDay) { 
            if (date::getDayOfWeek($singleDay) == 'Montag' || $singleDayKey == 0) {
                //new week
                echo '<br>neue Woche<br>';
                $weekStart = new Carbon;
                $weekStart = $weekStart->parse($singleDay)->toDateString();
                echo 'weekstart: '.$weekStart.'<br>';

              
                
                $weekEnd = new Carbon;
                $weekEnd = $weekEnd->parse($singleDay);
                $currentDate = $weekEnd->toDateString();
                $daysUntilWeekend = date::daysUntilLastWeekDay( $currentDate );
                $weekEnd = $weekEnd->addDays($daysUntilWeekend)->toDateString();
                echo 'weekend: '.$weekEnd.'<br>';
                // $week = new weeks;
                // $week->
            }
            
            if ( in_array( strtolower(date::getDayOfWeek($singleDay)), $schoolday ) ) {
                echo 'Schultag: '.date::getDayOfWeek($singleDay).' '.$singleDay;
            } else {
                echo 'Arbeitstag: '.date::getDayOfWeek($singleDay).' '.$singleDay;
            }
            echo  '<br>';
        }


    }


    /**
     * Returns the name of the day of week
     * @param date date
     */
    static function getDayOfWeek($date) {
        $weekDays = array(
            0   =>  'Sonntag',
            1   =>  'Montag',
            2   =>  'Dienstag',
            3   =>  'Mittwoch',
            4   =>  'Donnerstag',
            5   =>  'Freitag',
            6   =>  'Samstag'
        );
        $schoolday = new Carbon;
        $schoolday = $schoolday->parse($date);
        $schoolday = $schoolday->dayOfWeek;
        return $weekDays[$schoolday];
    }


    /**
     * returns the last day of the week - 'Sonntag' - important if the first week of period doesnt start on monday
     * 
     * @param weekEnd date
     * @param count int - already counted days until weekend
     */

    static function daysUntilLastWeekDay ($weekEnd, $count = 0) {
        if (date::getDayOfWeek($weekEnd) == 'Sonntag') {
            return $count;
        } else {
            $count++;
            $newWeekEnd = new Carbon;
            $newWeekEnd = $newWeekEnd->parse($weekEnd)->addDays(1)->toDateString();
            return date::daysUntilLastWeekDay($newWeekEnd, $count);
        }
    }

    /**
     * save dates to db
     * 
     * @param $dates array
     */
    protected function saveDates ($dates) {
        //echo 'save';
    }
}
