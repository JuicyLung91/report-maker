<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\weeks;
use App\oneDay;

class date extends Model
{

    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['date'];
    
    //add Period - add one week every 7 days https://scotch.io/tutorials/easier-datetime-in-laravel-and-php-with-carbon
    //check if a days is already set
    //add new date 
    
    /**
     * create a period of dates - calls weeks after every 7 days
     * 
     * @param $startdate, $enddate
     *  
     */
    public static function createPeriod ($startdate, $enddate, $schoolday, $trainingYear) {
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
        $newDate = new date;
        $newDate->saveDates($period);
        $weeks = array();
        foreach ($period as $singleDayKey => $singleDay) { 
            if (date::getDayOfWeek($singleDay) == 'Montag' || $singleDayKey == 0) {
                //new week
                $weekStart = new Carbon;
                $weekStart = $weekStart->parse($singleDay)->toDateString();

                $weekEnd = new Carbon;
                $weekEnd = $weekEnd->parse($singleDay);

                $currentDate = $weekEnd->toDateString();
                $daysUntilWeekend = date::daysUntilLastWeekDay( $currentDate );
                $weekEnd = $weekEnd->addDays($daysUntilWeekend)->toDateString();
                $weeks[$weekStart]['start'] = $weekStart;
                $weeks[$weekStart]['end'] = $weekEnd;
            }
            
            if ( in_array( strtolower(date::getDayOfWeek($singleDay)), $schoolday ) ) {
                $thisDay = new Carbon;
                $thisDay = $thisDay->parse($singleDay)->toDateString();
                $weeks[$weekStart]['schooldays'][] = $singleDay;
            }
        }
        $week = new weeks;
        $week->saveWeeks($weeks, $trainingYear);
        $oneDay = new date;
        $oneDay->saveOneDays($period);

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

    public function getWeekID($date) {
        $addDays = date::daysUntilLastWeekDay($date);
        $newDate = new Carbon;
        $newDate = $newDate->parse($date)->addDays($addDays)->toDateString();
        $dateID  =  date::where('date', $newDate)->first();

        if ($dateID) {
            $week = weeks::where('endDate', $dateID->IDdates)->first();
            if ($week) {
                return $week->IDweeks;

            } else {
                return false;
            }
        }

    }

    public function getDateID($date) {
        $dateID  =  date::where('date', $date)->first();
        return ($dateID) ? $dateID->IDdates : false;
    }

    /**
     * save dates to db
     * 
     * @param $dates array
     */
    public function saveDates ($dates) {
        foreach ($dates as $date ) {
            date::updateOrCreate(['date'=>$date]);

        }
    }


    public function saveOneDays ($dates) {
        foreach ($dates as $date ) {
            if ( $this->getDateID($date) ) {
                $weekID = $this->getWeekID($date);
                $dayID = $this->getDateID($date);
                oneDay::updateOrCreate(['date'=>$dayID,'weekID'=>$weekID]); 
            }
        }
    }


}
