<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewProjectAdded;
use App\Http\Controllers\Controller;
use App\Models\ClientUser;
use App\Models\Equipment;
use App\Models\Notification;
use App\Models\product_add;
use App\Models\product_task;
use App\Models\signatures;
use App\Models\task_data;
use App\Models\techUser;
use App\Models\type_service;
use App\Models\User;
use App\Models\warranty;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class JobAllocation extends Controller
{
    public function view(): View
    {

        $service = type_service::all();

        return view('admin.joballocation.joballoctaion_view', compact('service'));
    }

    public function find_client(Request $request): JsonResponse
    {

        $res = ClientUser::with('users')->where("office", "LIKE", "%{$request->term}%")
            ->get();

        return response()->json($res);
    }
    public function product_code(Request $request): JsonResponse
    {

        $res = product_add::with(['client_pdt', 'client_pdt.users', 'equip_pdt', 'warranty'])
            ->where("product_code", "LIKE", "%{$request->term}%")
            ->get();

        return response()->json($res);
    }
    public function serial_no(Request $request): JsonResponse
    {

        $res = product_add::with(['client_pdt', 'client_pdt.users', 'equip_pdt', 'warranty'])
            ->where("serial_number", "LIKE", "%{$request->term}%")
            ->get();

        return response()->json($res);
    }

    public function Equipment_job(Request $request): JsonResponse
    {


        $keyword = $request->term;
        $res = Equipment::where(function ($query) use ($keyword) {
            $query->where('Item_name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('Model', 'LIKE', '%' . $keyword . '%')
                ->orWhere('Brand', 'LIKE', '%' . $keyword . '%');
        })->get();

        return response()->json($res);
    }

    public function  update(Request $request): RedirectResponse
    {
        $time = Carbon::now()->toTimeString();
        $date_of_sch = $request->Date_Schedule;
        $req_date = Carbon::parse($date_of_sch)->setTimeFromTimeString($time);
        $dateTimeSuffix = date('Ymd_His');
        if ($request->Product_id) {
            $task = task_data::select('id')->where('id', 1)->first();
            $already = 'admin';
            $taskHistory = [
                'task_id' => $task->id,
                'date_time' =>  now(),
                'user_id' => Auth::user()->id,
                'already' => $already,
                'date_of_schedule' => $request->Date_Schedule,
                'assign' => Auth::user()->id,
                'Remarks' => $request->Remarks,
            ];


            // $existingTaskHistory = json_decode($data->taskhistory, true);
            // $serviceName ='Add_Job';
            // $suffixedServiceName = $serviceName;
            // $dateTimeSuffix = date('Ymd_His');
            // $counter = 1;
            // while (array_key_exists($suffixedServiceName, $existingTaskHistory)) {

            //     $suffixedServiceName = $serviceName . '_next_' . $dateTimeSuffix ;
            //     $counter++;
            // }


            // $existingTaskHistory[$suffixedServiceName] = $taskHistory;
            // $updatedJsonString = json_encode($existingTaskHistory);



            $existingTaskHistory[$dateTimeSuffix . '_next_' . 'Add_Job'] = $taskHistory;
            $updatedJsonString = json_encode($existingTaskHistory);

            $pdt_client_id=product_add::where('product_id',$request->Product_id)->first();

            $prdt_task = product_task::create([
                'product_id' => $request->Product_id,
                'type_services_id' => $request->type_services_id,
                'task_id' => $task->id,
                'date_of_schedule' => $request->Date_Schedule,
                'Reamarks' => $request->Remarks,
                'admin_id' => Auth::user()->id,
                'already' => $already,
                'taskhistory' => $updatedJsonString,
                'client_id'=>$pdt_client_id->client_id,
            ]);
            NewProjectAdded::dispatch($prdt_task);

            toastr()->success('Data has been saved successfully!');
            return redirect()->back();
        } else {

            $startDate = Carbon::createFromFormat('Y-m-d', $request->Date_Schedule);
            $endDate = $startDate->addMonths($request->Warranty_month);
            $endDate = $endDate->format('Y-m-d');
            $month = $request->Warranty_month ?: '0';
            $warranty = warranty::create([
                'month' => $month,
                'Start_date' => $request->Date_Schedule,
                'end_date' => $endDate,
                'warranty_type' => $request->warranty_type,
            ]);
            $WarrantyId = $warranty->id;

            $product = product_add::create([
                'client_id' => $request->client_id,
                'equipment_id' => $request->Equipment_id,
                'admin_id' => Auth::user()->id,
                'warranties_id' => $WarrantyId,
            ]);
            $productId = $product->product_id;

            $task = task_data::select('id')->where('id', 1)->first();
            $already = 'admin';
            $taskHistory = [
                'task_id' => $task->id,
                'date_time' =>  now(),
                'user_id' => Auth::user()->id,
                'already' => $already,
                'assign' => Auth::user()->id,
                'date_of_schedule' => $request->Date_Schedule,
                'Remarks' => $request->Remarks,
            ];
            $existingTaskHistory[$dateTimeSuffix . '_next_' . 'Add_Job'] = $taskHistory;
            $updatedJsonString = json_encode($existingTaskHistory);

            $prdt_task = product_task::create([
                'product_id' => $productId,
                'type_services_id' => $request->type_services_id,
                'task_id' => $task->id,
                'date_of_schedule' => $request->Date_Schedule,
                'Reamarks' => $request->Remarks,
                'admin_id' => Auth::user()->id,
                'already' => $already,
                'taskhistory' => $updatedJsonString,
                'client_id'=>$request->client_id,

            ]);
            // event(new NewProjectAdded($prdt_task));

            NewProjectAdded::dispatch($prdt_task);

            toastr()->success('Data has been saved successfully!');
            return redirect()->back();
        }
    }

    public function job_list(): view
    {
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->get()->sortBy('task_id');
        $task = task_data::all();

        return view('admin.joballocation.joblist', compact('prdt_task', 'task'));
    }
    public function job_list_each_task($task_id): view
    {
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('task_id', $task_id)->get()->sortBy('task_id');;
        $task = task_data::all();

        return view('admin.joballocation.joblist', compact('prdt_task', 'task', 'task_id'));
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


        return view('admin.joballocation.job_view', compact('data', 'prdt_task', 'admin_id', 'pdut_id', 'tech', 'taskHistoryArray', 'product_id_job', 'prdt_task_2', 'taskNames'));
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
        $data2 = ['base64Images' => $base64Images, 'image' => $image, 'data' =>  $data, 'prdt_task' => $prdt_task, 'admin_id' => $admin_id, 'pdut_id' => $pdut_id, 'tech' => $tech, 'taskHistoryArray' => $taskHistoryArray, 'product_id_job' => $product_id_job, 'prdt_task_2' => $prdt_task_2, 'taskNames' => $taskNames];


        $html = view('admin.Pdf.pdfdownload', $data2)->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->download($data->product_code . '.pdf');
    }


    public function job_search(Request $request): view
    {
        $start_date = $request->input('Start_date');
        $end_date = $request->input('End_date');
        $task_value = $request->input('Task_value');

        // Only perform validation if Start_date and End_date are present
        if ($start_date !== null || $end_date !== null) {
            $request->validate([
                'Start_date' => 'required|date',
                'End_date' => 'required|date|after_or_equal:start_date',
            ]);
        }
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])
            ->where(function ($query) use ($start_date, $end_date, $task_value) {
                $query->when($start_date !== null && $end_date !== null, function ($query) use ($start_date, $end_date) {
                    $query->whereBetween('created_at', [
                        $start_date . ' 00:00:00',
                        $end_date . ' 23:59:59',
                    ]);
                })
                    ->when($task_value !== null, function ($query) use ($task_value) {
                        $query->where('task_id', $task_value);
                    });
            })
            ->get();

        $search_page = [
            'start_date' => $start_date,
            'end_date'   => $end_date,
            'Task_value' => $task_value,
        ];

        $task = task_data::all();

        if ($start_date === null && $end_date === null && $task_value === null) {
            return $this->job_list();
        }

        return view('admin.joballocation.joblist', compact('prdt_task', 'task', 'search_page'));
    }
    public function notificationmarak(Request $request): view
    {
        $notifications = Notification::where('admin_id', Auth::user()->id)->first();
        auth()->user()->unreadNotifications->markAsRead();
        print_r('ha');
        die();
    }
    public function mark_as_read(Request $request, $id): view
    {
        $id = decrypt($id);
        $notifications = Notification::with('prdt_task')->find($id);


        $notifications->read_at = now();
        $notifications->save();

        return $this->job_list_view($request, encrypt($notifications->prdt_task->product_id));
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

    public function job_view(Request $request, $id): JsonResponse
    {

        $prdt_task = product_task::with(['product_add', 'product_add.equip_pdt', 'product_add.client_pdt', 'product_add.client_pdt.users'])->find($id);
        $res = $prdt_task;
        return response()->json($res);
    }
    public function Quotation_aproval(Request $request): RedirectResponse
    {
        $prdt_task = product_task::find($request->pdt_id_name_assign);
        $task = task_data::select('id')->where('id', 1)->first();

        $quotationValue = !empty($request->Quotation_value) ? 'Send Quotation' : "Aproval";


        $already = $prdt_task->admin_id;

        $taskHistory = [
            'task_id' =>  $task->id,
            'old_task_id' => $prdt_task->task_id,
            'date_time' => now(),
            'user_id' => Auth::user()->id,
            'already' => $already,
            'assign' =>  $prdt_task->admin_id,
            'Quotation_value' => $quotationValue,

        ];
        $data = product_task::with('task')->find($request->pdt_id_name_assign);
        $existingTaskHistory = json_decode($data->taskhistory, true);
        $serviceName = $data->task->task_name;
        $suffixedServiceName = $serviceName;
        $dateTimeSuffix = date('Ymd_His');
        $counter = 1;
        while (array_key_exists($suffixedServiceName, $existingTaskHistory)) {

            $suffixedServiceName = $dateTimeSuffix . '_next_' . $serviceName;
            $counter++;
        }


        $existingTaskHistory[$suffixedServiceName] = $taskHistory;
        $updatedJsonString = json_encode($existingTaskHistory);

        // $existingTaskHistory[$data->task->task_name ] = $taskHistory;


        // $updatedJsonString = json_encode($existingTaskHistory);

        $data->update([
            'taskhistory' => $updatedJsonString,
            'task_id' => $task->id,

        ]);

        toastr()->success('Job successfully Update!');

        NewProjectAdded::dispatch($prdt_task);
        return redirect()->back();
    }
}
