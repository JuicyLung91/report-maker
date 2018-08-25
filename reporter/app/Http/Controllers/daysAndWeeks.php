<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\date;
use App\invalidReason;

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
        $schoolday = 'donnerstag';
        $period = date::createPeriod($request->input('startdate'), $request->input('enddate'), $request->input('schoolday'));
        echo '<pre>';
        print_r($request->all());
        print_r($request->input('startdate'));
        print_r($period);
    }

    public function createInvalid (Request $request) {
        foreach ($request->input('invalidDate') as $invalid) {
            $invalidReason = new invalidReason;
            $invalidReason->createReson($invalid['date'], $invalid['reason']);
            //@TODO: call model foreach invalid date and save to db
        }
    }
}
