<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tasks;
use App\tasksHours;
use App\oneDay;
use App\daysToTasks;
use App\date;
use Carbon\Carbon;

class tasksAndHours extends Controller
{
    /**
     * adds one period of time
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

    public function updateTask(Request $request) {
        // echo 'test';
        if ( count($request['task']) == 0 || $request['task'][0]['name'] == '') {
            return 'Es wurden keine Aufgaben hinterlegt';
        }

        $tasks = $request['task'];
        $taskHours = 0;
        foreach ($tasks as $task) {
            $taskHours += $task['hour'];
            if ($taskHours > 8) {
                return 'Die Zahl der Aufgaben übersteigt 8 Stunden';
            }
        }
        $schooltask = $request['schoolday'] ? 1 : 0;


        $day = $request['dayid'];
        print_r($tasks);
        $task = new tasksAndHours();
        $task->removeTaskForOneDay($request['dayid']);
        foreach ($tasks as $task) {
            $hourID = tasksHours::where('hour', $task['hour'])->first()->IDtaskHours;
            $taskDescirption = $task['name'];
            // echo $hourID;
            //where time = $hourID and description = $task['name']
            $task = tasks::where('time', $hourID)->where('description', $taskDescirption)->first();
            if ($task) {
                $newTask = $task->IDtasks;
               
            } else {
                $task = new tasks();
                $task->name = $taskDescirption;
                $task->description = $taskDescirption;
                $task->schoolTask = $schooltask;
                $task->time = $hourID;
                $task->save();
                $newTask = tasks::where('time', $hourID)->where('description', $taskDescirption)->first()->IDtasks;
                echo 'newtask: '.$newTask;
            }

            if ($newTask) {
                echo '<br>Aufgabenid:'.$newTask.'<br>';
                $dayTask = new daysToTasks();
                $dayTask->oneDay = $day;
                $dayTask->task = $newTask;
                $dayTask->save();
            }

            
        }
        
        return redirect()->back();

    }

    public function removeTaskForOneDay($dayid) {
        echo 'dayid'.$dayid.'<br>';
        $tasks = daysToTasks::where('oneDay', $dayid)->delete();
        return true;
    }

    public function generateSingleDay (Request $request) {

        $dateID = $request['dateID'];
        $oneDayID = oneDay::where('date',$dateID)->firstOrFail()->IDoneDay;
        $this->removeTaskForOneDay($oneDayID);

        $day = oneDay::where('date', $dateID)->first();
        $this->randomizeDaysToTasks($day);

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
                $task = tasks::where($whereClause)->where('schooltask', 0)->inRandomOrder()->first();
                

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
