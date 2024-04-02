<?php

namespace App\View\Components;

use App\Models\product_task;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tasknameid extends Component
{ public $taskId;
    /**
     * Create a new component instance.
     */
    public function __construct($taskId)
    {
        $taskId_name=product_task::with(['Type_service'])->find( $taskId);
        $this->taskId = $taskId_name->Type_service->service_name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasknameid');
    }
}
