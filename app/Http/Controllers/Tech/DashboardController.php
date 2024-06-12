<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use App\Models\product_task;
use App\Models\warranty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index() : View{

        $warranties = warranty::where('end_date', '<', Carbon::today())->update(['warranty_type' => '2']);
        $war = ['text-success','text-danger','text-primary','text-info','text-warning','text-muted'];
        $task=product_task::with(['Type_service', 'task', 'users_pdt','product_add','product_add.client_pdt'])
        ->where('admin_id', Auth::user()->id)->latest()
        ->take(5)
        ->get();

        foreach ( $task as $key => $task_review) {

            $color_index = $key % count($war);

            $task_review->color_class = $war[$color_index];
        }

        $today = Carbon::today()->format('Y-m-d');
        $new_task = product_task::where('date_of_schedule', '<', $today)
                                ->where('task_id', '1')
                                ->update(['task_id' => '2']);

        return view('tech.dashboard.index',compact('task'));
    }
}
