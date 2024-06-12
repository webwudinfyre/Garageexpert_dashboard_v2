<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientUser;
use App\Models\customer_review;
use App\Models\product_task;
use App\Models\signatures;
use App\Models\task_data;
use App\Models\User;
use App\Models\warranty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index(Request $request): View
    {
        $today = Carbon::today()->format('Y-m-d');
        $new_task = product_task::where('date_of_schedule', '<', $today)
            ->where('task_id', '1')
            ->update(['task_id' => '2']);

        $data = Auth::user()->id;


        $client_data = ClientUser::where('user_id', $data)->first();


        $client_latest = product_task::with(['Type_service','product_add','product_add.equip_pdt'])->where('client_id',$client_data['id'] )->latest()->take(2)->get();

        $task_history_data = [];

        foreach ($client_latest as $task) {
            $task_history = json_decode($task['taskhistory'], true);
            $task_history['type_of_service_name'] = $task->Type_service->service_name;
            $task_history['product_add']= $task->product_add->product_id;
            $task_history_data[$task->id] = $task_history;
        }


        $taskHistoryArray = [];


        $taskNames = [];

        $taskHistoryArray = []; // Initialize the array outside the loop

        foreach ($client_latest  as $task) {
            $mergedArray = []; // Initialize the merged array for each task

            $taskId = $task->id;

            $task_id_name = $task->Type_service->service_name;
            $taskNames[$taskId] = $task_id_name;
            $taskHistory = json_decode($task->taskhistory, true);

            $keyNames = array_keys($taskHistory);

            // Sort task history items by date and time
            usort($keyNames, function ($a, $b) use ($taskHistory) {
                $dateTimeA = Carbon::parse($taskHistory[$a]['date_time']);
                $dateTimeB = Carbon::parse($taskHistory[$b]['date_time']);
                return $dateTimeA <=> $dateTimeB;
            });

            foreach ($keyNames as $key) {
                $details = $taskHistory[$key];
                $details['name'] =  $key;
                $details['task_name_status'] = task_data::find($details['task_id'])->task_name;
                $details['user_name'] = User::find($details['user_id'])->name;
                $details['assign_name'] = User::find($details['assign'])->name;
                $details['Services'] = $task->type_service->service_name;
                $details['Date_Of_Schedule'] = $task->date_of_schedule;

                $dateTime = Carbon::parse($details['date_time']);
                $details['date'] = $dateTime->toDateString();
                $details['time'] = $dateTime->toTimeString();


                if (isset($details['quotationValue_name'])) {
                    $details['quotationValue_value_data'] = $details['Quotation_value'];
                }
                $mergedArray['product_add'] =$task->product_add->product_id;
                $mergedArray['product_add_code'] =$task->product_add->product_code;
                $mergedArray['service_name'] =$task_id_name ;
                $mergedArray['Brand'] =$task->product_add->equip_pdt->Brand ;
                $mergedArray['Model'] =$task->product_add->equip_pdt->Model ;
                $mergedArray['Status'] = $task->task->task_name == 'New Task' ? 'Progress' : $task->task->task_name;
                $mergedArray['Item_naame'] =$task->product_add->equip_pdt->Item_name ;


                $mergedArray[$key] = $details;
            }

            $taskHistoryArray[$taskId] = $mergedArray; // Use the task ID as the key in the task history array
        }

        if($request->ajax())
        {
            return view('client.dashboard.index', compact('client_data','task_history_data','taskHistoryArray','client_latest'));
        }


        $war = ['text-success','text-danger','text-primary','text-info','text-warning','text-muted'];


        $customer_reviews = customer_review::with('product_task_rew', 'Type_service', 'product_task_rew.product_add', 'product_task_rew.product_add.client_pdt','tech_user_rew')
            ->where('client_id',$client_data['id'])
            ->latest()
            ->take(5)
            ->get();

        foreach ($customer_reviews as $key => $review) {

            $color_index = $key % count($war);

            $review->color_class = $war[$color_index];
        }
        $warranties = warranty::where('end_date', '<', Carbon::today())->update(['warranty_type' => '2']);
// print_r($taskHistoryArray);die();

        return view('client.dashboard.index', compact('client_data','task_history_data','taskHistoryArray','client_latest','customer_reviews'));
    }
}
