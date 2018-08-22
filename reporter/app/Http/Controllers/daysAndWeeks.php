<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\date;

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
    public function addPeriod () {
        $period = date::createPeriod('31-07-2017', '01-08-2018');
        print_r($period);
    }
}
