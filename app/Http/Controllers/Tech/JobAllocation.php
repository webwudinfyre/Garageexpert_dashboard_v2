<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\MailController;

use App\Events\NewProjectAdded;
use App\Models\aprovalquotation;
use App\Models\ClientUser;
use App\Models\customer_review;
use App\Models\Equipment;
use App\Models\mail_sending;
use App\Models\Notification;
use App\Models\product_add;
use App\Models\product_task;
use App\Models\signatures;
use App\Models\task_data;
use App\Models\task_tech_report;
use App\Models\techUser;
use App\Models\type_service;
use App\Models\User;
use App\Models\warranty;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use PhpParser\Node\Expr\Print_;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Support\Facades\Validator;

class JobAllocation extends Controller
{
    protected $MailController;
    public function view(): View
    {

        $service = type_service::all();

        return view('tech.joballocation.joballoctaion_view', compact('service'));
    }

    public function find_client(Request $request): JsonResponse
    {

        $res = ClientUser::with('users')->where("office", "LIKE", "%{$request->term}%")
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

        $taskHistory = [
            'task_id' => $task->id,
            'date_time' => $req_date,
            'user_id' => Auth::user()->id,
        ];
        $prdt_task = product_task::create([
            'product_id' => $productId,
            'type_services_id' => $request->type_services_id,
            'task_id' => $task->id,
            'date_of_schedule' => $request->Date_Schedule,
            'Reamarks' => $request->Remarks,
            'admin_id' => Auth::user()->id,
            'taskhistory' => json_encode($taskHistory),
        ]);
        // event(new NewProjectAdded($prdt_task));

        NewProjectAdded::dispatch($prdt_task);

        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }


    public function job_list_view(Request $request, $id): view
    {
        $id = decrypt($id);
        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt', 'sign'])->where('product_id', $data->product_id)->get();
        $prdt_task_2 = product_task::where('product_id', $data->product_id)

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
        return view('tech.joballocation.job_view', compact('data', 'prdt_task', 'admin_id', 'pdut_id', 'tech', 'taskHistoryArray', 'product_id_job', 'prdt_task_2', 'taskNames'));
    }

    public function jobpdfdowmload(Request $request, $id)
    {
        // {
        $id = decrypt($id);
        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt', 'sign'])->where('product_id', $data->product_id)->get();
        $prdt_task_2 = product_task::where('product_id', $data->product_id)->first();

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

        $tech = techUser::all();
        $data2 = ['base64Images' => $base64Images, 'image' => $image, 'data' =>  $data, 'prdt_task' => $prdt_task, 'admin_id' => $admin_id, 'pdut_id' => $pdut_id, 'tech' => $tech, 'taskHistoryArray' => $taskHistoryArray, 'product_id_job' => $product_id_job, 'prdt_task_2' => $prdt_task_2, 'taskNames' => $taskNames];

        $html = view('tech.Pdf.pdfdownload', $data2)->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->download($data->product_code . '.pdf');



        //  return view('tech.pdf.pdfdownload', $data2);
    }
    public function job_list(): view
    {

        $task = task_data::all();
        $tech = techUser::all();
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('already', 'admin')->get()
            ->groupBy('task.task_name');

        return view('tech.joballocation.joblist', compact('prdt_task', 'task', 'tech'));
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
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('already', 'admin')
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
            ->get()->groupBy('task.task_name');

        $search_page = [
            'start_date' => $start_date,
            'end_date'   => $end_date,
            'Task_value' => $task_value,
        ];

        $task = task_data::all();
        $tech = techUser::all();
        if ($start_date === null && $end_date === null && $task_value === null) {
            return $this->job_list();
        }

        return view('tech.joballocation.joblist', compact('prdt_task', 'task', 'search_page', 'tech'));
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
    public function job_view(Request $request, $id): JsonResponse
    {

        $prdt_task = product_task::with(['product_add', 'product_add.equip_pdt', 'product_add.client_pdt', 'product_add.client_pdt.users'])->find($id);
        $res = $prdt_task;
        return response()->json($res);
    }
    public function job_taken(Request $request): RedirectResponse
    {



        $already = Auth::user()->id;
        $task = task_data::select('id')->where('id', 1)->first();
        $taskHistory = [
            'task_id' =>  $task->id,
            'date_time' => now(),
            'user_id' => Auth::user()->id,
            'already' => $already,
            'assign' => Auth::user()->id,
            'Remarks' => 'job taken',
        ];
        $data = product_task::find($request->pdt_id_name);


        $dateTimeSuffix = date('Ymd_His');

        $existingTaskHistory = json_decode($data->taskhistory, true);

        $serviceName = $dateTimeSuffix . '_next_' . 'Job_Myself';

        $suffixedServiceName = $serviceName;

        $counter = 1;
        while (array_key_exists($suffixedServiceName, $existingTaskHistory)) {

            $suffixedServiceName = $dateTimeSuffix . '_next_' . $serviceName;
            $counter++;
        }


        $existingTaskHistory[$suffixedServiceName] = $taskHistory;
        $updatedJsonString = json_encode($existingTaskHistory);


        $takenby = Auth::user()->id;
        $admin_id = Auth::user()->id;

        $data->update(['taskhistory' => $updatedJsonString, 'taken' => $takenby, 'admin_id' => $admin_id, 'already' => $already]);

        toastr()->success('Job has been saved successfully!');
        return redirect()->back();
    }
    public function job_assign(Request $request): RedirectResponse
    {
        $already = $request->Technician_name_assign;

        $task = task_data::select('id')->where('id', 1)->first();
        $taskHistory = [
            'task_id' => $task->id,
            'date_time' => now(),
            'user_id' => Auth::user()->id,
            'already' => $already,
            'assign' =>  $request->Technician_name_assign,
            'Remarks' => 'job_assign',
        ];
        $data = product_task::find($request->pdt_id_name_assign);;


        $dateTimeSuffix = date('Ymd_His');

        $existingTaskHistory = json_decode($data->taskhistory, true);

        $serviceName = $dateTimeSuffix . '_next_' . 'job_assign';

        $suffixedServiceName = $serviceName;

        $counter = 1;
        while (array_key_exists($suffixedServiceName, $existingTaskHistory)) {

            $suffixedServiceName = $dateTimeSuffix . '_next_' . $serviceName;
            $counter++;
        }


        $existingTaskHistory[$suffixedServiceName] = $taskHistory;
        $updatedJsonString = json_encode($existingTaskHistory);




        $takenby = $already;
        $admin_id = $already;

        $data->update(['taskhistory' => $updatedJsonString, 'taken' => $takenby, 'admin_id' => $admin_id, 'already' => $already]);

        toastr()->success('Job has been Assign successfully!');
        return redirect()->back();
    }
    public function Technician_name(Request $request): JsonResponse
    {


        $keyword = $request->term;
        $res = techUser::where(function ($query) use ($keyword) {
            $query->where('firstname', 'LIKE', '%' . $keyword . '%')
                ->orWhere('lastname', 'LIKE', '%' . $keyword . '%');
        })->get();

        return response()->json($res);
    }



    public function myjob_list(): view
    {

        $task = task_data::all();
        $tech = techUser::all();
        $techname = Auth::user()->id;
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('already', $techname)->get()
            ->groupBy('task.task_name')
            ->sortBy('task.task_name');

        return view('tech.joballocation.Myjoblist', compact('prdt_task', 'task', 'tech'));
    }
    public function myjob_list_each_task($task_id): view
    {

        $task = task_data::all();
        $tech = techUser::all();
        $techname = Auth::user()->id;
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('already', $techname)->where('task_id', $task_id)->get()
            ->groupBy('task.task_name')
            ->sortBy('task.task_name');

        return view('tech.joballocation.Myjoblist', compact('prdt_task', 'task', 'task_id', 'tech'));
    }

    public function myjob_search(Request $request): view
    {

        $start_date = $request->input('Start_date');
        $end_date = $request->input('End_date');
        $task_value = $request->input('Task_value');
        $techname = Auth::user()->id;
        // Only perform validation if Start_date and End_date are present
        if ($start_date !== null || $end_date !== null) {
            $request->validate([
                'Start_date' => 'required|date',
                'End_date' => 'required|date|after_or_equal:start_date',
            ]);
        }
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('already', $techname)
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
            ->get()->groupBy('task.task_name')
            ->sortBy('task.task_name');

        $search_page = [
            'start_date' => $start_date,
            'end_date'   => $end_date,
            'Task_value' => $task_value,
        ];

        $task = task_data::all();
        $tech = techUser::all();
        if ($start_date === null && $end_date === null && $task_value === null) {
            return $this->myjob_list();
        }

        return view('tech.joballocation.Myjoblist', compact('prdt_task', 'task', 'search_page', 'tech'));
    }
    public function jobinstall(Request $request, $id): view
    {
        $id = decrypt($id);

        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt'])->where('id', $id)
            ->latest('created_at')->get();

        foreach ($prdt_task as $task) {

            $admin_id = $task->admin_id;
            $pdut_id = $task->id;
            $product_id = $task->product_id;
            $prdt_task_id = $task->id;
            $type_services = $task->Type_service->service_name;
        }
        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($product_id);




        return view('tech.joballocation.jobinstall', compact('data', 'prdt_task', 'admin_id', 'prdt_task_id', 'type_services'));
    }
    public function signature_save(Request $request): RedirectResponse
    {


// print_r($request->all());die();
        $data = product_task::with('Type_service')->find($request->producttask_id);

        $slnum1 = product_add::where('product_id', $data->product_id)->first();

        if (empty($slnum1->serial_number)) {
            $validator = Validator::make($request->all(), [
                'Serial_no' => 'required|unique:product_adds,serial_number',

            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Serial number already taken'); // Add an error message
            }
            $slnum = product_add::where('product_id', $data->product_id)->update(['serial_number' => $request->Serial_no]);
        }


        $notifications = Notification::where('product_tasks_id', $request->producttask_id)
            ->get();

        $notificationsToUpdate = $notifications->reject(function ($notification) {
            return $notification->tech_admin === null;
        });
        foreach ($notificationsToUpdate as $notification) {


            $notification->update(['read_at' => now()]);
        }




        $signatures_data = signatures::create([
            'product_tasks_id' => $request->producttask_id,
            'name' => $request->name_client,
            'postion' => $request->Postion,
            'email_id_sign' => $request->Email_client,
            'phone_sign' => $request->phone_client,
            'signature_data' => $request->signature,


        ]);

        $sign_email=$request->Email_client;
        $quotationValue = $request->Quotation_value === '1' ? 'Send Quotation' : "Don't Send Quotation";

        if ($quotationValue === 'Send Quotation') {
            $task = task_data::select('id')->where('id', 3)->first();
            $quotationValue_name = '1';
        } else {
            $task = task_data::select('id')->where('id', 4)->first();
            $quotationValue_name = '1';
        }



        $already = Auth::user()->id;

        $taskHistory = [
            'task_id' =>  $task->id,
            'date_time' => now(),
            'user_id' => Auth::user()->id,
            'already' => $already,
            'assign' =>  Auth::user()->id,
            'Remarks' => $request->Remarks,
            'quotationValue_name' => $quotationValue_name,
            'Quotation_value' => $quotationValue,
            'signatures_data' => $signatures_data->id,

        ];

        $data = product_task::with('Type_service')->find($request->producttask_id);


        $pduct_id = product_add::find($data->product_id);

        $existingTaskHistory = json_decode($data->taskhistory, true);

        $serviceName = $data->Type_service->service_name;

        $suffixedServiceName = $serviceName;
        $dateTimeSuffix = date('Ymd_His');
        $counter = 1;
        while (array_key_exists($suffixedServiceName, $existingTaskHistory)) {

            $suffixedServiceName = $dateTimeSuffix . '_next_' . $serviceName;
            $counter++;
        }


        $existingTaskHistory[$suffixedServiceName] = $taskHistory;
        $updatedJsonString = json_encode($existingTaskHistory);


        $takenby = $already;
        $admin_id = $already;

        $data->update([
            'taskhistory' => $updatedJsonString,
            'task_id' => $task->id,
            'Reamarks' => $request->Remarks,
            'taken' => $takenby,
            'admin_id' => $admin_id,
            'already' => $already
        ]);
        $pduct_id = encrypt($pduct_id->product_id);




        $task = task_tech_report::create([
            'product_task_id' => $request->producttask_id,
            'tech_user_id' => $already,
            'date_of_schedule' => $data->date_of_schedule,
            'date' => now(),

        ]);

        $data3 = product_task::with('Type_service', 'product_add', 'product_add.client_pdt', 'product_add.equip_pdt')->find($request->producttask_id);


        $tech_id=techUser::where('user_id', Auth::user()->id)->first();
//  printf($data3);die();
        $customer = customer_review::create([
            'product_tasks_id' =>  $data3->id ,
            'type_services_id' => $data3['type_services_id'],
            'admin_id' => $data3->product_add->client_pdt->user_id,
            'product_id' => $data3->product_id,
            'client_id' => $data3->product_add->client_pdt->id,
            'equipment_id' => $data3->product_add->equip_pdt->id,
            'tech_user_id' => $tech_id['user_id'],
        ]);
        if($request->addmore)
        {
            foreach($request->addmore as $addmore) {

                $mail_sending = mail_sending::firstWhere([
                    'email' => $addmore['email_mail'],

                    'product_tasks_id' => $data3->id,
                    'product_id' => $data3->product_id,
                ]);

                if (!$mail_sending) {

                    $mail_sending = new mail_sending([
                        'email' => $addmore['email_mail'],
                        'name' => $addmore['name_mail'],
                        'product_tasks_id' => $data3->id,
                    'product_id' => $data3->product_id,
                    ]);

                    // Save the new mail_sending record to the database
                    $mail_sending->save();
                }
            }
        }




        $result = app('App\Http\Controllers\MailController')->index($data3->product_id, $data3->id,$sign_email);
        toastr()->success('Job has been Assign successfully!');



        return redirect()->route('tech.joballocation.job_list_view', ['id' => $pduct_id]);
    }


    public function index_task(Request $request): JsonResponse
    {


        $start = $request->query('start');
        $end = $request->query('end');

        $tasks = product_task::with('task', 'product_add.client_pdt')
            ->where(function ($query) use ($start, $end) {
                $query->where('admin_id', Auth::user()->id)
                    ->whereBetween('updated_at', [$start, $end])
                    ->orWhereBetween('date_of_schedule', [$start, $end]);

            })
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
        $date = $request->date;

        $start = new DateTime($date);
        $start->setTime(0, 0, 0); // Set time to 00:00:00

        $end = new DateTime($date);
        $end->setTime(23, 59, 59); // Set time to 23:59:59


        $startString = $start->format('Y-m-d');
        $endString = $end->format('Y-m-d');

        $startString_date = $start->format('Y-m-d H:i:s');
        $endString_date = $end->format('Y-m-d H:i:s');

 // Retrieve tasks where date_of_schedule is within the specified range
 $tasks = product_task::with('product_add', 'product_add.equip_pdt', 'task', 'product_add.client_pdt')
 ->whereBetween('date_of_schedule', [$startString, $endString])
 ->where('admin_id', Auth::user()->id)
 ->where('task_id', '!=', 4)
 ->get();

// Retrieve tasks where task_id = 4 and updated_at is within the specified range
$tasks2 = product_task::with('product_add', 'product_add.equip_pdt', 'task', 'product_add.client_pdt')
 ->where('task_id', 4)
 ->where('admin_id', Auth::user()->id)
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
