<?php

namespace App\View\Components;

use App\Models\ClientUser;
use App\Models\product_add;
use App\Models\product_task;
use App\Models\task_data;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskListclient extends Component
{
    public $tasks;
    public $taskCounts;
    public $data_id1;
    public $admin;
    public $taskdata;
    /**
     * Create a new component instance.
     */
    public function __construct($adminId, $admin)
    {
        $taskdata = task_data::all();

        $this->taskCounts = [];
        $this->data_id1 = [];


        $admin_id_data = ClientUser::where('user_id', $adminId)->first();

        $prduct = product_add::where('client_id', $admin_id_data['id'])->get();
        // print_r($admin_id_data['id']);die();
        $task_counts = []; // Array to store task counts

        foreach ($prduct as $data) {
            $tasks = product_task::where('product_id', $data->product_id)->get();

            foreach ($tasks as $task) {
                $task_id = $task->task_id;


                if (isset($task_counts[$task_id])) {
                    $task_counts[$task_id]++;
                } else {
                    $task_counts[$task_id] = 1;
                }
            }
        }




        $this->admin = $admin;
        $this->taskCounts = $task_counts;
        $this->taskdata = $taskdata;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task-listclient',  [
            'taskCounts' => $this->taskCounts,
            'data_id1' => $this->data_id1,
            'admin' =>  $this->admin,
            'taskdata ' => $this->taskdata,
        ]);
    }
}
