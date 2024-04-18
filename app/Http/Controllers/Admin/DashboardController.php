<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\customer_review;
use App\Models\product_task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DashboardController extends Controller
{
    function index(): View
    {
        $war = ['text-success','text-danger','text-primary','text-info','text-warning','text-muted'];


        $customer_reviews = customer_review::with('product_task_rew', 'Type_service', 'product_task_rew.product_add', 'product_task_rew.product_add.client_pdt','tech_user_rew')
            ->latest()
            ->take(5)
            ->get();

        foreach ($customer_reviews as $key => $review) {

            $color_index = $key % count($war);

            $review->color_class = $war[$color_index];
        }

        $task=product_task::with(['Type_service', 'task', 'users_pdt','product_add','product_add.client_pdt'])->latest()
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


        // printf( $today .'--'.$new_task);die();


        return view('admin.dashboard.index',compact('customer_reviews','task'));    }
}
