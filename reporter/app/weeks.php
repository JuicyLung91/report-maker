<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\date;
use App\tasks;
use App\invalidReason;
use App\invalidDays;
use Carbon\Carbon;

class weeks extends Model
{

    protected $fillable = ['startDate', 'endDate', 'schoolDate', 'schoolDayName', 'workingDays', 'trainingYear'];
    protected $table = 'weeks';
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function start()
    {
        return $this->belongsTo('App\date', 'startDate', 'IDdates');
    }
    public function endDate()
    {
        return $this->belongsTo('App\date', 'endDate', 'date');
    }

    /**
     * 
     * add new week 
     * @param $startdate $enddate drame date
     * 
     */
    public function addNewWeek ($startdate, $enddate) {
        
    }

    //return one week - get dates and invalid dates
    
    //get tasks for a specific week

    //return weeks in a period

    //return all weeks

    /**
     * save weeks to db
     * 
     * @param $week array
     */
    public function saveWeeks ($weeks, $trainingYear) {
        foreach ($weeks as $week ) {
            $schoolDateIds = array();
            if (isset($week['schooldays'])) {
                $schoolDateNames = array();
                foreach ($week['schooldays'] as $school) {
                    $schoolDate = date::where('date', $school)->first();
                    $schoolDateIds[$schoolDate->IDdates] = $schoolDate->IDdates;
                    $dayName = date::getDayOfWeek($school);
                    $schoolDateNames[$dayName] = $dayName;
                }
                $schoolIDs = implode(',', $schoolDateIds);
                $schoolDays = implode(',', $schoolDateNames);
            } else {
                $schoolDays = null;
                $schoolIDs = null;
            }


            
            print_r($week);
            $weekStartID = date::where('date', $week['start'])->firstOrFail();
            $weekEndID = date::where('date', $week['end'])->firstOrFail();


            weeks::updateOrCreate([
                'startDate'=> $weekStartID->IDdates,
                'endDate'=> $weekEndID->IDdates,
                'schoolDate'=> $schoolIDs,
                'schoolDayName'=> $schoolDays,
                'workingDays'=> 7 - count($schoolDateIds),
                'trainingYear'  => $trainingYear
                ]
            );
        }
    }

    public function friendlyWeek($week) {

        $startDate = date::where('IDdates', $week->startDate)->first()->date;
        $endDate =  date::where('IDdates', $week->endDate)->first()->date;
        $schoolDates = $this->getSchoolDayOfWeek($week);
        
        $schoolDayNames = explode(',', $week->schoolDayName);

        $friendlyWeek = array();
        $friendlyWeek['Wochennummer'] = $week->IDweeks;
        $friendlyWeek['Ausbildungsjahr'] = $week->trainingYear;
        $friendlyWeek['Wochenstart'] = date::officialDate($startDate);
        $friendlyWeek['Wochenende'] = date::officialDate($endDate);
        $friendlyWeek['Schuldaten'] = $schoolDates;
        $friendlyWeek['Schultage'] = $schoolDayNames;
        $friendlyWeek['tage'] = $this->getAllDaysOfWeek($week);
        //$friendlyWeek['workingDays'] = $week->workingDays;


        // echo '<pre>';
        // print_r($friendlyWeek);
        
        // echo '</pre>';

        return $friendlyWeek;
    }

    public function getAllDaysOfWeek($week) {
        $days = oneDay::where('weekID', $week->IDweeks)->get();
        $schoolDays = $this->getSchoolDayOfWeek($week);
        $friendlyDays = array();

        foreach ($days as $key => $day) {
            $dayID = $day->date;
            $oneDayID = $day->IDoneDay;
            $date = date::where('IDdates', $dayID)->first()->date;
            $fullDay = date::getDayOfWeek($date);
            $friendlyDays[$fullDay]['ID'] = $dayID;
            $friendlyDays[$fullDay]['oneDayID'] = $oneDayID;
            $friendlyDays[$fullDay]['Datum'] = date::officialDate($date);
            $tasks = new tasks;
            $friendlyDays[$fullDay]['Aufgaben'] = $tasks->getTasksOfDay($oneDayID);
            if ( in_array($date, $schoolDays) ) {
                $friendlyDays[$fullDay]['Schultag'] = true;
            } else {
                $friendlyDays[$fullDay]['Schultag'] = false;
            }          
            $invalidDay = invalidDays::where('date', $dayID)->first();
            
            if ($invalidDay) {
                
                $reason = invalidReason::where('IDinvalidReasons', $invalidDay->reason)->first();
                $friendlyDays[$fullDay]['invalid'] = $reason->reason;
            }
        }


        return $friendlyDays;
    }
    public function getSchoolDayOfWeek ($week) {
        $schoolDates = explode(',', $week->schoolDate);
        foreach ( $schoolDates as $key => $s ) {
            $date = date::where('IDdates', $s)->first();
            if ($date) {
                $schoolDates[$key] = $date->date;
            }
        }
        return $schoolDates;
    }

}
