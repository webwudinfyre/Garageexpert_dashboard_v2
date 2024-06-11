<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\customer_review;
use App\Models\Equipment;
use App\Models\Notification;


use App\Models\type_service;

use App\Models\warranty;


use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;

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
        // return view('admin.Pdf.taskpadfdownload', $data2);
    }
    public function techreport(): View
    {

        $finalData = [];


        $taskdata = task_data::all();


        $product_tasks = product_task::all();


        $techusers = techUser::all();


        foreach ($techusers as $techuser) {

            $techUserTasks = [];

            $product_id = $product_tasks->where('admin_id', $techuser->user_id)->count();

            foreach ($taskdata as $task) {

                $filtered_tasks = $product_tasks->where('task_id', $task->id)
                    ->where('admin_id', $techuser->user_id);



                $taskCount = $filtered_tasks->count();
                if ($taskCount > 0) {
                    $techUserTasks[$task->task_name] = $taskCount;
                }
            }

            $finalData[$techuser->firstname] = [
                'name' => $techuser->firstname . ' ' . $techuser->lastname,
                'tasks' => $techUserTasks,
                'product_id' => $product_id,
                'techuser_id' => $techuser->id,
            ];
        }

        return view('admin.reports.report_tech', compact('techusers', 'finalData'));
    }
    public function techreport_view($id): View
    {

        // print_r($id);die();
        $techusers = techUser::find($id);
        $prdt_task = product_task::with('product_add', 'product_add.client_pdt', 'Type_service', 'task')->where('admin_id', $techusers->user_id)->get();
        return view('admin.reports.report_tech_view', compact('prdt_task', 'techusers'));
    }
    public function customer_review(): View
    {


        // $customer_reviews = customer_review::select(
        //     'customer_reviews.equipment_id',
        //     'eqpt.Item_name',
        //     'eqpt.Model',
        //     'eqpt.Brand',
        //     'eqpt.Size',
        //     'eqpt.id',
        //     'customer_reviews.Product_reviews_star',
        //     DB::raw('count(*) as total'),
        //     DB::raw('AVG(customer_reviews.Product_reviews_star) as average_star')
        // )
        // ->join('equipment as eqpt', 'customer_reviews.equipment_id', '=', 'eqpt.id')
        // ->groupBy('customer_reviews.equipment_id', 'eqpt.id', 'eqpt.Item_name', 'eqpt.model', 'eqpt.Brand', 'eqpt.Size', 'customer_reviews.Product_reviews_star')
        // ->get();


        $product_review = customer_review::select(
            'customer_reviews.equipment_id',

            'eqpt.Item_name',
            'eqpt.Model',
            'eqpt.Brand',
            'eqpt.Size',
            'eqpt.id',
            'eqpt.item_id',


            DB::raw('COUNT(*) as total_reviews'),
            DB::raw('ROUND((AVG(customer_reviews.Product_reviews_star) / 5) * 5) as average_rating_out_of_5')
        )
            ->join('equipment as eqpt', 'customer_reviews.equipment_id', '=', 'eqpt.id')
            ->groupBy('customer_reviews.equipment_id')
            ->get();

        $tech_reviews = customer_review::select(
            'customer_reviews.tech_user_id',
            'users.name',

            DB::raw('COUNT(*) as total_reviews'),
            DB::raw('ROUND((AVG(customer_reviews.tech_reviews_star) / 5) * 5) as average_rating_out_of_5')
        )
            ->join('equipment as eqpt', 'customer_reviews.equipment_id', '=', 'eqpt.id')
            ->join('users as users', 'customer_reviews.tech_user_id', '=', 'users.id')
            ->groupBy('customer_reviews.tech_user_id')
            ->get();

        // printf($product_review);
        // die();
        return view('admin.reports.customer_review', compact('product_review', 'tech_reviews'));
    }
    public function reviewdetails($id): view
    {

        $eqpt_id = Equipment::find($id);
        $customer_reviews = customer_review::with('product_task_rew', 'Type_service', 'product_task_rew.product_add', 'product_task_rew.product_add.client_pdt')
            ->where('equipment_id', $id)->get();


        return view('admin.reports.customer_review_details', compact('eqpt_id', 'customer_reviews'));
    }
    public function reviewdetails_tech($id): view
    {


        $tech_id = techUser::with('tech_user_rew')->where('user_id', $id)->first();
        $customer_reviews = customer_review::with('product_task_rew', 'Type_service', 'product_task_rew.product_add', 'product_task_rew.product_add.client_pdt')
            ->where('tech_user_id', $id)->get();


        return view('admin.reports.tech_review_details', compact('tech_id', 'customer_reviews'));
    }
    public function index_task(Request $request): JsonResponse
    {


        $start = $request->query('start');
        $end = $request->query('end');

        $tasks = product_task::with('task', 'product_add.client_pdt')
            ->orWhereBetween('date_of_schedule', [$start, $end])
            ->orwhereBetween('updated_at', [$start, $end])
            ->get();

        $events = $tasks->map(function ($task) {
            $start = $task->date_of_schedule; // Default start date
            $end = $task->date_of_schedule; // Default end date

            // Replace start and end dates if task_id is 4
            if ($task->task_id == 4) {
                $start = $task->updated_at->format('Y-m-d');
                $end = $task->updated_at->format('Y-m-d');
            }

            return [
                'title' => $task->product_add->client_pdt->office, // Assuming 'office' is the title
                'start' => $start,
                'end' => $end,
                'color' => $this->getEventColor($task->task->task_name), // Get color based on task name
            ];
        })->toArray();

        return response()->json($events);
    }
    private function getEventColor($status)
    {
        switch ($status) {
            case 'Completed':
                return 'green';
            case 'Pending':
                return 'blue';
            case 'New Task':
                return 'orange';
            case 'Quotation':
                return 'red';
                case 'Waiting Approve':
                    return 'black';
            default:
                return 'white';
        }
    }

    public function get_event_details(Request $request): JsonResponse
    {

        // $start = $request->date ;
        // $end = $request->date;
        // $tasks = product_task::with('task','product_add.client_pdt')->whereBetween('updated_at', [$start, $end])
        //     ->orWhereBetween('updated_at', [$start, $end])
        //     ->get();
        $date = $request->date;

        // Assuming $request->date is in 'Y-m-d' format
        // Create DateTime objects for the start and end of the day
        $start = new DateTime($date);
        $start->setTime(0, 0, 0); // Set time to 00:00:00

        $end = new DateTime($date);
        $end->setTime(23, 59, 59); // Set time to 23:59:59

        // Format the DateTime objects back to strings if needed
        $startString = $start->format('Y-m-d');
        $endString = $end->format('Y-m-d');

        $startString_date = $start->format('Y-m-d H:i:s'); // Format with time (00:00:00)
        $endString_date = $end->format('Y-m-d H:i:s');

        // Retrieve tasks where date_of_schedule is within the specified range
        $tasks = product_task::with('product_add', 'product_add.equip_pdt', 'task', 'product_add.client_pdt')
            ->whereBetween('date_of_schedule', [$startString, $endString])
            ->where('task_id', '!=', 4)
            ->get();

        // Retrieve tasks where task_id = 4 and updated_at is within the specified range
        $tasks2 = product_task::with('product_add', 'product_add.equip_pdt', 'task', 'product_add.client_pdt')
            ->where('task_id', 4)
            ->whereBetween('updated_at', [$startString_date, $endString_date])
            ->get();

        // Store results into arrays
        $tasksArray = $tasks->toArray();
        $tasks2Array = $tasks2->toArray();
        $result = [
            'tasks' => $tasksArray,
            'tasks2' => $tasks2Array
        ];
        return response()->json($result);
    }

    public function tracking_details(): view
    {
        $data = Auth::user()->id;


        $client_data = ClientUser::where('user_id', $data)->first();


        $client_latest = product_task::with(['Type_service', 'product_add', 'task', 'product_add.equip_pdt'])->latest()->paginate(6);

        $task_history_data = [];

        foreach ($client_latest as $task) {
            $task_history = json_decode($task['taskhistory'], true);
            $task_history['type_of_service_name'] = $task->Type_service->service_name;
            $task_history['product_add'] = $task->product_add->product_id;
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
                $mergedArray['product_add'] = $task->product_add->product_id;
                $mergedArray['product_add_code'] = $task->product_add->product_code;
                $mergedArray['service_name'] = $task_id_name;
                $mergedArray['Brand'] = $task->product_add->equip_pdt->Brand;
                $mergedArray['Model'] = $task->product_add->equip_pdt->Model;
                $mergedArray['Status'] = $task->task->task_name == 'New Task' ? 'Progress' : $task->task->task_name;

                $mergedArray['Item_naame'] = $task->product_add->equip_pdt->Item_name;


                $mergedArray[$key] = $details;
            }

            $taskHistoryArray[$taskId] = $mergedArray; // Use the task ID as the key in the task history array
        }
        return view('admin.other.timeline', compact('client_data', 'task_history_data', 'taskHistoryArray', 'client_latest'));
    }

    public function product_list() :view {

        $data= product_add::with(['equip_pdt','client_pdt', 'warranty'])->get();

        return view('admin.reports.productlist',compact('data'));

    }
}
