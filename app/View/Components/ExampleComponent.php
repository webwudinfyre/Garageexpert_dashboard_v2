<?php

namespace App\View\Components;

use App\Models\product_task;
use App\Models\task_data;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExampleComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $taskCounts;



    public function __construct($adminId)
    {


        $taskdata = task_data::all();

        $this->taskCounts = [];


        foreach ($taskdata as  $taskdata) {
            $taskCount[$taskdata->task_name] = product_task::where('task_id', $taskdata->id)->where('admin_id', $adminId)->count();
        }

        $this->taskCounts = $taskCount;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.example-component', [
            'taskCounts' => $this->taskCounts,
        ]);
    }
}
