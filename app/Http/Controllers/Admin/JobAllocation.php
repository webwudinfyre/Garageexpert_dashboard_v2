<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientUser;
use App\Models\Equipment;
use App\Models\product_add;
use App\Models\type_service;
use App\Models\User;
use App\Models\warranty;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function Equipment_job(Request $request): JsonResponse
    {


            $keyword=$request->term;
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

        $endDate= $endDate->format('Y-m-d');
        $month = $request->Warranty_month ?: '0';
        $warranty= warranty::create([
            'month' => $month,
            'Start_date' =>$request->Date_Schedule,
            'end_date' => $endDate,
            'warranty_type'=>$request->warranty_type,
        ]);
        $WarrantyId = $warranty->id;

        $product=product_add::create([
            'client_id'=>$request->client_id,
            'type_services_id'=>$request->type_services_id,
            'equipment_id'=>$request->Equipment_id,
            'date_of_schedule'=>$request->Date_Schedule,
            'Reamarks'=>$request->Remarks,
            'admin_id'=>Auth::user()->id,
            'warranties_id'=>$WarrantyId,
        ]);

        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }
}
