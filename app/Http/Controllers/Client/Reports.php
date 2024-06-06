<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\aprovalquotation;
use App\Models\ClientUser;
use App\Models\customer_review;
use App\Models\Notification;
use App\Models\product_add;
use App\Models\product_task;
use App\Models\signatures;
use App\Models\task_data;
use App\Models\techUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use DateTime;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class Reports extends Controller
{
    public function office_list(Request $request) : View {

        $client_name_id=ClientUser::where('user_id',Auth::user()->id)->first();
        $client_users = ClientUser::with(['Product_add_client', 'Product_add_client.equip_pdt', 'Product_add_client.warranty'])->find($client_name_id->id);

        $client_users_sub = collect();
        if ($client_users->suboffice === 'main') {
            $client_users_sub = ClientUser::with(['Product_add_client', 'Product_add_client.equip_pdt', 'Product_add_client.warranty'])->where('suboffice', $client_name_id->id)->get();
        }
        if ($client_users_sub->isEmpty()) {
            $client_users_sub = "No_suboffice";
        } else {
            $client_users_sub = $client_users_sub;
        }


        return view('client.reports.office_list', compact('client_users', 'client_users_sub'));
    }
    public function job_list_view(Request $request, $id): view
    {
        $id = decrypt($id);
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


        return view('client.reports.job_view', compact('data', 'prdt_task', 'admin_id', 'pdut_id', 'tech', 'taskHistoryArray', 'product_id_job', 'prdt_task_2', 'taskNames'));
    }
    public function mark_as_read(Request $request, $id): view
    {
        $id = decrypt($id);
        $notifications = Notification::with('prdt_task')->find($id);


        $notifications->read_at = now();
        $notifications->save();

        return $this->job_list_view($request, encrypt($notifications->prdt_task->product_id));
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
                if(isset($details['date_of_schedule']))
                {
                    $details['Date_Of_Schedule'] = $details['date_of_schedule'];
                }


                $dateTime = Carbon::parse($details['date_time']);
                $details['date'] = $dateTime->toDateString();
                $details['time'] = $dateTime->toTimeString();

                if (isset($details['signatures_data'])) {
                    $details['signatures_data'] = signatures::find($details['signatures_data']);
                }
                if (isset($details['quotationValue_name'])) {
                    $details['quotationValue_value_data'] = $details['Quotation_value'];
                }
                if (isset($details['aproval_waiting'])) {
                    $details['aproval_waiting'] =aprovalquotation::find($details['aproval_waiting']);
                }

                $mergedArray[$key] = $details;
            }

            $taskHistoryArray[$taskId] = $mergedArray; // Use the task ID as the key in the task history array
        }




        $tech = techUser::all();


        return view('client.reports.job_view', compact('data', 'prdt_task', 'admin_id', 'pdut_id', 'tech', 'taskHistoryArray', 'product_id_job', 'prdt_task_2', 'taskNames'));
    }
    public function taskpdfdowmload(Request $request, $id)
    {
        $id = $id;

        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt', 'sign', 'product_add', 'product_add.client_pdt', 'product_add.equip_pdt', 'product_add.warranty'])->find($id);

        $imagePaths = array(
            public_path() . '/admin/assets/img/Header.png',
            public_path() . '/admin/assets/img/Garage-Logo-White.png',
            public_path() . '/admin/assets/img/watermark.png',
            public_path() . '/admin/assets/img/Footer.png',

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

        return view('client.Pdf.taskpadfdownload', $data2);
    }
    public function jobpdfdowmload(Request $request, $id)
    {
        $id = decrypt($id);
        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt', 'sign'])->where('product_id', $data->product_id)->get();
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
                if(isset($details['date_of_schedule']))
                {
                    $details['Date_Of_Schedule'] = $details['date_of_schedule'];
                }


                $dateTime = Carbon::parse($details['date_time']);
                $details['date'] = $dateTime->toDateString();
                $details['time'] = $dateTime->toTimeString();

                if (isset($details['signatures_data'])) {
                    $details['signatures_data'] = signatures::find($details['signatures_data']);
                }
                if (isset($details['quotationValue_name'])) {
                    $details['quotationValue_value_data'] = $details['Quotation_value'];
                }
                if (isset($details['aproval_waiting'])) {
                    $details['aproval_waiting'] =aprovalquotation::find($details['aproval_waiting']);
                }

                $mergedArray[$key] = $details;
            }

            $taskHistoryArray[$taskId] = $mergedArray; // Use the task ID as the key in the task history array
        }


        $tech = techUser::all();

        $imagePaths = array(
            public_path() . '/admin/assets/img/Header.png',
            public_path() . '/admin/assets/img/Garage-Logo-White.png',
            public_path() . '/admin/assets/img/watermark.png',
            public_path() . '/admin/assets/img/Footer.png',

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
        $data2 = ['base64Images' => $base64Images, 'image' => $image, 'data' =>  $data, 'prdt_task' => $prdt_task, 'admin_id' => $admin_id, 'pdut_id' => $pdut_id, 'tech' => $tech, 'taskHistoryArray' => $taskHistoryArray, 'product_id_job' => $product_id_job, 'prdt_task_2' => $prdt_task_2, 'taskNames' => $taskNames];


        $html = view('client.Pdf.pdfdownload', $data2)->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->download($data->product_code . '.pdf');
    }
    public function client_review(Request $request,$id) :  view {

        $id = $id;
        $client_id=ClientUser::where('user_id',$id)->first();
        // print_r($client_id['id']);die();

        $customer_reviews=customer_review::with('product_task_rew','Type_service','product_task_rew.product_add','product_task_rew.product_add.equip_pdt')->where('client_id',$client_id['id'])->get();



        return view('client.reports.reviews', compact( 'customer_reviews'));

    }

    public function client_review_edit($id) :view {

        $id1 = decrypt($id);
        $customer_reviews=customer_review::with('product_task_rew','Type_service','product_task_rew.product_add','product_task_rew.product_add.warranty','product_task_rew.product_add.equip_pdt')->find($id1);

        // printf($customer_reviews);die();
        return view('client.reports.product_review', compact( 'customer_reviews'));
    }
    public function update(Request $request) : RedirectResponse{

        $customer_review = customer_review::find($request->id);

        // print_r($request->all());die();

        $customer_review=customer_review::where('id',$request->id)->update([
            'Product_reviews_star' => $request->rating_1,
            'Product_reviews' => $request->input('comment_product'),
            'tech_reviews_star' => $request->rating_2,
            'tech_reviews' => $request->input('comment_tech'),
        ]);

        return redirect()->back();
    }

    public function tracking_details() : view {
        $data = Auth::user()->id;


        $client_data = ClientUser::where('user_id', $data)->first();


        $client_latest = product_task::with(['Type_service','product_add','task','product_add.equip_pdt'])->where('client_id',$client_data['id'] )->latest()->paginate(6);

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
        return view('client.other.timeline', compact('client_data','task_history_data','taskHistoryArray','client_latest'));
    }

    public function  mark_as_read_all(Request $request, $id): RedirectResponse
    {
        $id = decrypt($id);
        $notifications = Notification::with('prdt_task')->where('admin_id', $id)->get();


        foreach ($notifications as $notification) {
            $notification->update(['read_at' => Carbon::now()]);
        }


        return redirect()->back();
    }
}
