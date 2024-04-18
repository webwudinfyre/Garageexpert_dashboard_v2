<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use App\Models\product_task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index() : View{
        $today = Carbon::today()->format('Y-m-d');
        $new_task = product_task::where('date_of_schedule', '<', $today)
                                ->where('task_id', '1')
                                ->update(['task_id' => '2']);
        return view('tech.dashboard.index');
    }
}
