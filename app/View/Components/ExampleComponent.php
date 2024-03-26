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
    public $data_id1;

    public function __construct($adminId)
    {
        $taskdata = task_data::all();

        $this->taskCounts = [];
        $this->data_id1 = [];

        foreach ($taskdata as $data) {
            $taskCount[$data->task_name] = product_task::where('task_id', $data->id)
                                                      ->where('admin_id', $adminId)
                                                      ->count();
            $this->data_id1[$data->task_name] = $data->id;
        }

        $this->taskCounts = $taskCount;
    }

    public function render(): View|string
    {
        return view('components.example-component', [
            'taskCounts' => $this->taskCounts,
            'data_id1' => $this->data_id1,
        ]);
    }
}
