<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tasks;
use App\tasksHours;
use App\oneDay;
use App\daysToTasks;
use App\date;

class tasksAndHours extends Controller
{
    /**
     * adds on period of time
     * 
     * @param startdate date
     * @param enddate date
     * @param schooldays array
     * 
     */
    public function createTask (Request $request) {
        foreach ($request->task as $task) {
            $schooltask = isset($task['schoolTask']) ? true : false;
            print_r($task);
            tasks::createTasks($task['name'],$task['description'],$schooltask, $task['hour']);
        }
        return redirect()->back();
    }


    public function generateTasks ($week = false) {
        if (!$week) {
            $oneDays = oneDay::get();
        }
        $c = 0;
        foreach ($oneDays as $day) {
            //TODO if schoolday
            //TODO if invaidDay
            // if ($c<20) {
                $this->randomizeDaysToTasks($day);
            // }
            $c++;
        }
        //return redirect()->back();
    }

    public function getTaskDescription ($oneDayID) {
        echo 'oneDay'.$oneDayID;
        $taskID = daysToTasks::where('oneDay', $oneDayID)->first();
        if ($taskID) {
            $tasks = tasks::where('IDtasks', $taskID['task'])->get();
            $descriptions = array();
            foreach ($tasks as $task) {
                $descriptions[] = $task->description;
            }
            print_r($descriptions);
            return $descriptions;
        } else {
            return false;
        }
    }

    public function randomizeDaysToTasks($day) {
        $tasks = new tasks;
        echo $day;
        $allTasksOfDay = $tasks->getTasksOfDay($day->IDoneDay);
        var_dump($allTasksOfDay);
        $totalHours = intval (array_sum( $allTasksOfDay ) );
        echo '<br>';
            echo '<br>';
        echo '-------<br>Neue Aufgabe<br>';
        echo 'TagID: ';
        echo $day->date;
        echo '<br>';

        echo 'OneDay: ';
        echo $day->IDoneDay;
        echo '<br>';
        echo 'Total Zeit für den Tag:'.$totalHours.'<br>';
        $leftHour = 8 - $totalHours;
        if ( $totalHours <= 8 && $leftHour > 0 ) {
            echo 'Zeit die Übrig bleibt '.$leftHour.'<br>';
            $taskHour = $task = tasksHours::where('hour', '<=', $leftHour)->inRandomOrder()->first();

            if ($taskHour) {
                $taskHour = $taskHour->IDtaskHours;
                
                $tasksBefore = $this->getTaskDescription($day->IDoneDay);
                $before = array();
                $whereClause = array();
                if ($tasksBefore) {
                    foreach ($tasksBefore as $not) {
                        $before[] = ['description', 'NOT LIKE','%'.$not.'%'];
                    }
                    $whereClause = $before;
                }
                $whereClause[] = ['time', $taskHour];
                $task = tasks::where($whereClause)->inRandomOrder()->first();
                

                $thisTasksDuration = tasksHours::where('IDtaskHours', $task->time)->first()->hour;
                $newTaskForDay = new daysToTasks;
                $newTaskForDay->task = $task->IDtasks;
                $newTaskForDay->oneDay = $day->IDoneDay;
                $newTaskForDay->save();
                // $leftHour = 

                //$leftHour = 8 - $thisTasksDuration;
                echo 'Aufgabebeschreibung '.$task->description.'<br>';
                echo 'Dauer '.$thisTasksDuration.'<br>';

                if ($leftHour != $thisTasksDuration ) {
                    //echo $leftHour.'<br><br>';
                    echo 'Weitere Aufgaben holen<br>';
                    $this->randomizeDaysToTasks($day);
                }
            }
            echo '--------<br>';
            
        }
    }
}
