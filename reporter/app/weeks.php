<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\date;
use App\tasks;

class weeks extends Model
{

    protected $fillable = ['startDate', 'endDate', 'schoolDate', 'schoolDayName', 'workingDays', 'trainingYear'];
    const UPDATED_AT = null;
    const CREATED_AT = null;

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
            $schoolDateNames = array();
            foreach ($week['schooldays'] as $school) {
                $schoolDate = date::where('date', $school)->first();
                $schoolDateIds[$schoolDate->IDdates] = $schoolDate->IDdates;
                $dayName = date::getDayOfWeek($school);
                $schoolDateNames[$dayName] = $dayName;
            }
            $schoolIDs = implode(',', $schoolDateIds);
            $schoolDays = implode(',', $schoolDateNames);

            $newWeek = new weeks;

            $weekStartID = date::where('date', $week['start'])->first();
            $weekEndID = date::where('date', $week['end'])->first();

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
        $friendlyWeek['Wochenstart'] = $startDate;
        $friendlyWeek['Wochenende'] = $endDate;
        $friendlyWeek['Schuldaten'] = $schoolDates;
        $friendlyWeek['Schultage'] = $schoolDayNames;
        $friendlyWeek['tage'] = $this->getAllDaysOfWeek($week);
        //$friendlyWeek['workingDays'] = $week->workingDays;


        echo '<pre>';
        print_r($friendlyWeek);
        
        echo '</pre>';

        return $friendlyWeek;
    }

    public function getAllDaysOfWeek($week) {
        $days = oneDay::where('weekID', $week->IDweeks)->get();
        $schoolDays = $this->getSchoolDayOfWeek($week);
        $friendlyDays = array();

        foreach ($days as $key => $day) {
            $dayID = $day->date;
            $date = date::where('IDdates', $dayID)->first()->date;
            $friendlyDays[$key]['Datum'] = $date;
            $tasks = new tasks;
            //TODO if day invlaid then add reason else add aufgaben
            $friendlyDays[$key]['Aufgaben'] = $tasks->getTasksOfDay($dayID);
            if ( in_array($date, $schoolDays) ) {
                $friendlyDays[$key]['Schultag'] = true;
            } else {
                $friendlyDays[$key]['Schultag'] = false;
            }          
        }


        return $friendlyDays;
    }
    public function getSchoolDayOfWeek ($week) {
        $schoolDates = explode(',', $week->schoolDate);
        foreach ( $schoolDates as $key => $s ) {
            $schoolDates[$key] = date::where('IDdates', $s)->first()->date;
        }
        return $schoolDates;
    }

}
