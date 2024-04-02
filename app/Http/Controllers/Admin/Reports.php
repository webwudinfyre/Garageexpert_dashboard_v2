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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class Reports extends Controller
{
    public function clientreport(): View
    {

        return view('admin.reports.report_client');
    }
    public function  clientreport_search(Request $request): View
    {
        $client_users = ClientUser::with(['Product_add_client','Product_add_client.equip_pdt','Product_add_client.warranty'])->find($request->client_name_id);

        $client_users_sub = collect();
        if ($client_users->suboffice === 'main') {
            $client_users_sub = ClientUser::with(['Product_add_client','Product_add_client.equip_pdt','Product_add_client.warranty'])->where('suboffice', $request->client_name_id)->get();
        }
        if ($client_users_sub->isEmpty()) {
            $client_users_sub="No_suboffice";
        } else {
            $client_users_sub= $client_users_sub;
        }

        return view('admin.reports.report_client', compact('client_users', 'client_users_sub'));
    }
    public function   prdct_view_task(Request $request,$id): JsonResponse
    {

        $data = product_task::with('Type_service','users_pdt','task')->where('product_id',$id)->get();
        return response()->json( $data );
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

            $task_id_name= $task->Type_service->service_name;
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


        return view('admin.joballocation.job_view', compact('data', 'prdt_task', 'admin_id', 'pdut_id', 'tech', 'taskHistoryArray', 'product_id_job', 'prdt_task_2','taskNames'));
    }
    public function taskpdfdowmload(Request $request, $id)
    {
        $id = $id;

        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt', 'sign','product_add'])->find($id);
 return view();

        printf($prdt_task);die();



        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
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

            $task_id_name= $task->Type_service->service_name;
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

        $imagePaths = array(
            public_path() . '/admin/assets/img/header@4x.png',
            public_path() . '/admin/assets/img/Garage-Logo-White.png',
            public_path() . '/admin/assets/img/watermark.png',
            public_path() . '/admin/assets/img/Footer_1@4x.png',

        );

        // Associative array to store base64 encoded images
        $base64Images = array();

        foreach ($imagePaths as $key => $path1) {
            $type = pathinfo($path1, PATHINFO_EXTENSION);
            $imagePathsdata = file_get_contents($path1);
            $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($imagePathsdata);
            $base64Images["image$key"] = $base64Image;
        }

        $path = public_path() . '/admin/assets/img/header@4x.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data1);

        // $tech = techUser::all();
        $data2 = ['base64Images' => $base64Images, 'image' => $image, 'data' =>  $data, 'prdt_task' => $prdt_task, 'admin_id' => $admin_id, 'pdut_id' => $pdut_id, 'tech' => $tech, 'taskHistoryArray' => $taskHistoryArray, 'product_id_job' => $product_id_job, 'prdt_task_2' => $prdt_task_2,'taskNames'=>$taskNames];


        $html = view('admin.Pdf.pdfdownload', $data2)->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->download($data->product_code . '.pdf');
    }


}
