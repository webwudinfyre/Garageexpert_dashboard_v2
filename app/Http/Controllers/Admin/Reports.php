<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ClientUser;
use App\Models\product_add;
use App\Models\product_task;
use App\Models\signatures;
use App\Models\task_data;
use App\Models\techUser;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


use App\Events\NewProjectAdded;

use App\Models\Equipment;
use App\Models\Notification;


use App\Models\type_service;

use App\Models\warranty;


use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;



class Reports extends Controller
{
    public function clientreport(): View
    {

        return view('admin.reports.report_client');
    }
    public function  clientreport_search(Request $request): View
    {
        $client_users = ClientUser::with(['Product_add_client', 'Product_add_client.equip_pdt', 'Product_add_client.warranty'])->find($request->client_name_id);

        $client_users_sub = collect();
        if ($client_users->suboffice === 'main') {
            $client_users_sub = ClientUser::with(['Product_add_client', 'Product_add_client.equip_pdt', 'Product_add_client.warranty'])->where('suboffice', $request->client_name_id)->get();
        }
        if ($client_users_sub->isEmpty()) {
            $client_users_sub = "No_suboffice";
        } else {
            $client_users_sub = $client_users_sub;
        }

        return view('admin.reports.report_client', compact('client_users', 'client_users_sub'));
    }
    public function   prdct_view_task(Request $request, $id): JsonResponse
    {

        $data = product_task::with('Type_service', 'users_pdt', 'task')->where('product_id', $id)->get();
        return response()->json($data);
    }
    public function task_list_view(Request $request, $id): view
    {
        $id = $id;
        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt'])->where('product_id', $data->product_id)->get();

        $prdt_task_2 = product_task::where('product_id', $data->product_id) // Sort by created_at in descending order
            ->first();

        foreach ($prdt_task as $task) {

            $admin_id = $task->admin_id;
            $pdut_id = $task->id;

            $product_id_job = $task->product_id;
        }
        $taskHistoryArray = [];


        $taskNames = [];

        $taskHistoryArray = []; // Initialize the array outside the loop

        foreach ($prdt_task as $task) {
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

                if (isset($details['signatures_data'])) {
                    $details['signatures_data'] = signatures::find($details['signatures_data']);
                }
                if (isset($details['quotationValue_name'])) {
                    $details['quotationValue_value_data'] = $details['Quotation_value'];
                }

                $mergedArray[$key] = $details;
            }

            $taskHistoryArray[$taskId] = $mergedArray; // Use the task ID as the key in the task history array
        }




        $tech = techUser::all();


        return view('admin.joballocation.job_view', compact('data', 'prdt_task', 'admin_id', 'pdut_id', 'tech', 'taskHistoryArray', 'product_id_job', 'prdt_task_2', 'taskNames'));
    }
    public function taskpdfdowmload(Request $request, $id)
    {
        $id = $id;

        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt', 'sign', 'product_add', 'product_add.client_pdt', 'product_add.equip_pdt', 'product_add.warranty'])->find($id);

        $imagePaths = array(
            public_path() . '/admin/assets/img/Asset_6@4x.png',
            public_path() . '/admin/assets/img/Asset_6@4x.png',
            public_path() . '/admin/assets/img/watermark.png',
            public_path() . '/admin/assets/img/Footer_1@4x.png',
        );

        // Initialize an array to store base64 encoded images
        $base64Images = array();

        foreach ($imagePaths as $key => $path) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $imageData = file_get_contents($path);
            $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
            $base64Images["image$key"] = $base64Image;
        }

        $data = json_decode($prdt_task->taskhistory, true);

        // Initialize variables to keep track of the latest date-time and its corresponding key
        $latestDateTime = null;
        $latestSignaturesData = null;

        // Loop through each item in the array
        foreach ($data as $item) {
            // Check if the current item has a date_time and signatures_data
            if (isset($item['date_time']) && isset($item['signatures_data'])) {
                // Convert the date_time string to a DateTime object for comparison
                $currentDateTime = new DateTime($item['date_time']);

                // If this is the first item or the current item's date_time is later than the latest found so far
                if ($latestDateTime === null || $currentDateTime > $latestDateTime) {
                    // Update the latest date_time and signatures_data
                    $latestDateTime = $currentDateTime;
                    $latestSignaturesData = $item['signatures_data'];
                }
            }
        }
        // Extract the corresponding values into a new array
        $latestValues = $latestSignaturesData;


        $client_signatures = signatures::find($latestValues);


        $data2 = ['base64Images' => $base64Images, 'prdt_task' => $prdt_task, 'client_signatures' => $client_signatures];


        $html = view('admin.Pdf.taskpadfdownload', $data2)->render();


        $pdf = FacadePdf::loadHTML($html);

        return $pdf->download($prdt_task->product_add->product_code . '.pdf');
        return view('admin.Pdf.taskpadfdownload', $data2);
    }
    public function techreport() : View {

        $finalData = [];


        $taskdata = task_data::all();


        $product_tasks = product_task::all();


        $techusers = techUser::all();


        foreach ($techusers as $techuser) {

            $techUserTasks = [];

            $product_id=$product_tasks->where('admin_id', $techuser->user_id)->count();

            foreach ($taskdata as $task) {

                $filtered_tasks = $product_tasks->where('task_id', $task->id)
                                                ->where('admin_id', $techuser->user_id);



                $taskCount = $filtered_tasks->count();
                if ($taskCount > 0) {
                    $techUserTasks[$task->task_name] = $taskCount;
                }
            }

            $finalData[$techuser->firstname] = [
                'name' => $techuser->firstname .' '.$techuser->lastname,
                'tasks' => $techUserTasks,
                'product_id'=> $product_id,
                'techuser_id'=>$techuser->id,
            ];

        }

        return view('admin.reports.report_tech',compact('techusers','finalData'));
    }
    public function techreport_view($id) :  View {

        // print_r($id);die();
        $techusers = techUser::find($id);
        $prdt_task=product_task::with('product_add','product_add.client_pdt','Type_service', 'task')->where('admin_id',$techusers->user_id)->get();
        return view('admin.reports.report_tech_view',compact('prdt_task','techusers'));
    }
    public function customer_review() : View {

        return view('admin.reports.customer_review');
    }

}
