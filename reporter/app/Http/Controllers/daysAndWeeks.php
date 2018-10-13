<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\date;
use App\invalidReason;
use App\weeks;
use App\oneDay;
use App\daysToTasks;
use App\tasks;
use App\tasksHours;

class daysAndWeeks extends Controller
{
    /**
     * adds on period of time
     * 
     * @param startdate date
     * @param enddate date
     * @param schooldays array
     * 
     */
    public function createPeriod (Request $request) {
        $period = date::createPeriod( $request->input('startdate'), $request->input('enddate'), $request->input('schoolday'), $request->input('trainingYear') );
        return redirect()->back();
    }

    public function showWeeks() {
        $weeks = weeks::all();
        return view('weeks')->with('weeks', $weeks);
    }

    public function showOneWeek($id) {
        
        $week = weeks::where('IDweeks', $id)->firstOrFail();
        // $weeks = weeks::all();
        $friendly = new weeks;
        $friendlyWeek = $friendly->friendlyWeek($week);
        return view('oneweek')->with('week', $friendlyWeek);
    }

  


    public function createInvalid (Request $request) {
        foreach ($request->input('invalidDate') as $invalid) {
            $invalidReason = new invalidReason;
            $invalidReason->createReson($invalid['date'], $invalid['reason']);
            //@TODO: call model foreach invalid date and save to db
            return redirect()->back();
        }
    }
}
