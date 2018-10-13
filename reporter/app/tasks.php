<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\tasksHours;
use App\tasks;
use App\daysToTasks;

class tasks extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    //protected $fillable = ['date'];
    

    /**
     * create a task
     * 
     * @param string $description
     * @param string $hour
     *  
     */
    public static function createTasks ($name, $description, $schoolTask=false, $hour) {
        $task = new tasks;
        $task->name = $name;
        $task->description = $description;
        $task->schoolTask = ($schoolTask) ? 1 : 0;
        $task->time = tasks::createTasksHours($hour);
        $task->save();
    }
    /**
     * create a taskshours
     * 
     * @param string $hours
     * @return IDtaskHours
     */
    public static function createTasksHours ($hour) {

        $h = tasksHours::firstOrCreate(
            [
                'hour'  => $hour
            ]
        )->where('hour',$hour)->first();

        return $h->IDtaskHours;
    }


    public function getTasksOfDay($oneDay) {
        $tasksArray = array();
        $dayToTasks = daysToTasks::where('oneDay', $oneDay)->get();
        foreach ($dayToTasks as $key => $dayToTask) {
            $taskID = $dayToTask->task;
            $task = tasks::where('IDtasks', $taskID)->first();
            $taskDescription = $task->description;
            $taskDuration = tasksHours::where('IDtaskHours', $task->time)->first()->hour;
            if (isset($tasksArray[$taskDescription])) {
                $tasksArray[$taskDescription] += $taskDuration;
            } else {
                $tasksArray[$taskDescription] = $taskDuration;
            }
        }
        return $tasksArray;
    }
}
