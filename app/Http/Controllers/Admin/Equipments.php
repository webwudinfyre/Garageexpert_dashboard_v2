<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Equipments extends Controller
{
    public function view() : View {


        $items = Equipment::orderBy(DB::raw('Brand IS NOT NULL AND Model IS NOT NULL AND Item_Name IS NOT NULL'), 'desc')
        ->orderBy('Item_Name', 'desc')
        ->get();

        return view('admin.equip.equip_view', compact('items'));
    }
    public function equipment_create(Request $request) : RedirectResponse
    {

       $validate=$request->validate([
            'item_id' => 'required|unique:equipment,item_id',
        ]);
        if(($validate))
        {
            $user = Equipment::create([
                'item_id' => $request->item_id,
                'Item_name' => $request->Item_name,
                'Brand' => $request->Brand,
                'Model' => $request->Model,
            ]);

            toastr()->success('Data has been saved successfully!');
            return redirect()->back();
        }
        else
        {
            toastr()->error('An error has occurred, please try again later.');
            return redirect()->back();
        }


    }
    public function  equipments_view(Request $request, $id): JsonResponse
    {

        $userId = $id;
        $responseData = Equipment::find($userId);
        return response()->json(['data' => $responseData]);
    }
    public function  equipment_update(Request $request): RedirectResponse
    {



        $id = $request->id;
        $equipdetails = Equipment::find($id);

        $equipdetails_old = [


            'Item_name' =>$equipdetails->Item_name,
            'Brand' => $equipdetails->Brand,
            'Model' => $equipdetails->Model,
        ];

        $changes = array_diff($request->only(['Brand', 'Item_name', 'Model']), $equipdetails_old);

        if (!empty($changes)) {


            $equipdetails->update($changes);
            toastr()->success('Data has been Update successfully!');
            return redirect()->back();
        } else {
            toastr()->info('No Updation');
            return redirect()->back();
        }
    }
    public function equipment_delete(Request $request): RedirectResponse
    {
        $id=$request->id;
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        toastr()->success('Data has been Delete successfully!');
        return redirect()->back();
    }


}
