<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\date;
use App\weeks;

class invalidReason extends Model
{
    //

    const UPDATED_AT = null;
    const CREATED_AT = null;
    /**
     * create a reson
     */
    public function createReson ($date, $reason) {
      $dateFormat = 'Y-m-d';
      $day = new Carbon;
      $date = Carbon::createFromFormat($dateFormat, $date);
      $date = $day->parse($date)->toDateString();
      $newReason = new invalidReason;
      if ( !$newReason->where('reason', $reason)->first() ) {
        $newReason->reason = $reason;
        $newReason->save();
      }
      $reasonInDB = $newReason->where('reason', $reason)->first();
      $reasonInDB = $reasonInDB->IDinvalidReasons;
      echo $reasonInDB.'<br>';
      
      $newDate = new date;
      if ( !$newDate->where('date', $date)->first() ) {
        $newDate->date = $date;
        $newDate->save();
      } 
      $dateInDB = $newDate->where('date', $date)->first();
      $dateInDB = $dateInDB->IDdates;
      echo $dateInDB;


      $daysUntilSunday = date::daysUntilLastWeekDay($date);
      $sunday = Carbon::parse($date)->addDays($daysUntilSunday)->toDateString();
      $sundayDateID = $newDate->where('date', $sunday)->first();
      $sundayDateID = $sundayDateID->IDdates;
      
      if ($sundayDateID) {
        $week = new weeks;
        $week = $week->where('endDate', $sundayDateID)->first();
        echo  $week;
      }
      
      //@TODO
      //look for date::daysUntilLastWeekDay add days to date and look for weeks based on the endDate and get id
    }

    /**
     * read a resons
     */
    function readReason () {

    }

     /**
      * update a reason
      */
      function updateReson () {

    }


    function deleteReson () {

    }
      /**
       * delete a resons
       */
}
