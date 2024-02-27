<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use App\Models\techUser;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class profile extends Controller
{




    public function tech_profile_main($id): View
    {
        $id = decrypt($id);

        $Adminusers = techUser::with('users')->where('user_id',$id)->first();

        return view('tech.profile_view.tech_view', compact('Adminusers'));
    }
    public function tech_profilecreate_social(Request $request, $id): RedirectResponse
    {

        $id = decrypt($id);
        $adminUser = techUser::with('users')->find($id);

        $existingData = [

            'Website' => $adminUser->linkedin,
            'facebook' => $adminUser->facebook,
            'instagram' => $adminUser->instagram,
            'twitter' => $adminUser->twitter,
        ];

        $changes = array_diff($request->only(['linkedin', 'facebook', 'instagram', 'twitter']), $existingData);

        if (!empty($changes)) {


            $adminUser->update($changes);
            toastr()->success('Data has been Update successfully!');
            return redirect()->back();
        } else {
            toastr()->info('No Updation');
            return redirect()->back();
        }
    }

    public function tech_profilebasic_details(Request $request, $id): RedirectResponse
    {

        $id = decrypt($id);
        $adminUser = techUser::with('users')->find($id);
        $request->validate([
            'Email' => 'required|email|unique:users,email,' . $adminUser->users->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs('images', $profileImage, 'images');


            if ($adminUser->avatar) {
                Storage::disk('images')->delete('images/' . $adminUser->avatar);
            }

            $imageprofile = "$profileImage";
        } else {
            $imageprofile = $adminUser->avatar;
        }

        $existingData = [

            'firstname' => $adminUser->firstname,
            'lastname' => $adminUser->lastname,
            'phonenumber' => $adminUser->phonenumber,
            'avatar' => $adminUser->avatar,
            'Address' => $adminUser->Address,
            'name' => $adminUser->users->name,
            'email' => $adminUser->users->email,
            'Position' => $adminUser->Position,
            'Gender' => $adminUser->Gender,

        ];
        $userdata = [

            'firstname' => $request->First_Name,
            'lastname' => $request->Last_Name,
            'phonenumber' => $request->Phone_number,
            'avatar' => $imageprofile,
            'Address' => $request->Address,
            'Position' => $request->Postion,
            'name' => $request->First_Name . ' ' . $request->Last_Name,
            'email' => $request->Email,
            'Gender' => $request->Gender,
        ];

        $changes = array_diff($userdata, $existingData);


        if (!empty($changes)) {


            $adminUser->update($changes);
            $adminUser->users()->update([
                'name' => $request->First_Name . ' ' . $request->Last_Name,
                'email' => $request->Email,
            ]);
            toastr()->success('Data has been Update successfully!');
            return redirect()->back();
        } else {
            toastr()->info('No Updation');
            return redirect()->back();
        }
    }

}
