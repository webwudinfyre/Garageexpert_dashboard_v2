<?php

namespace App\Http\Middleware;

use App\Models\product_task;
use App\Models\task_data;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountTasksMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $taskdata=task_data::all();
        $taskCount =[];
        $data_id1 = [];
        foreach( $taskdata as  $taskdata)
        {
            $taskCount[$taskdata->task_name] = product_task::where('task_id',$taskdata->id)->count();
            $data_id1[$taskdata->task_name] = $taskdata->id;
        }


        // Share the count with all views
        view()->share('taskCount', $taskCount);
        view()->share('data_id1', $data_id1);

        return $next($request);
    }
}
