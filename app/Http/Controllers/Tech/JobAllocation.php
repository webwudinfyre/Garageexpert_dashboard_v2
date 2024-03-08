<?php

namespace App\Http\Controllers\tech;

use App\Http\Controllers\Controller;

use App\Events\NewProjectAdded;

use App\Models\ClientUser;
use App\Models\Equipment;
use App\Models\Notification;
use App\Models\product_add;
use App\Models\product_task;
use App\Models\task_data;
use App\Models\type_service;
use App\Models\User;
use App\Models\warranty;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class JobAllocation extends Controller
{
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
            'date_time' => $request->Date_Schedule,
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

    public function job_list(): view
    {

        $task = task_data::all();
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('taken_by', '1')->get()
            ->groupBy('task.task_name');

        return view('tech.joballocation.joblist', compact('prdt_task', 'task'));
    }

    public function job_list_view(Request $request, $id): view
    {
        $id = decrypt($id);
        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt'])->where('product_id', $data->product_id)
            ->latest('created_at')->get();





        return view('tech.joballocation.job_view', compact('data', 'prdt_task'));
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
        $prdt_task = product_task::with(['product_add.equip_pdt', 'product_add.client_pdt', 'Type_service', 'task'])->where('taken_by', '1')
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

        if ($start_date === null && $end_date === null && $task_value === null) {
            return $this->job_list();
        }

        return view('tech.joballocation.joblist', compact('prdt_task', 'task', 'search_page'));
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
}
