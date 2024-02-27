<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientUser;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class profile extends Controller
{
    public function client_profile($id): view
    {
        $id = decrypt($id);
        $Adminusers = ClientUser::with('users')->find($id);
        $sub_office = ClientUser::with('users')->where('suboffice', $id)->get();

        $officemain = "4gghjgj";
        if (($Adminusers->suboffice) === 'main') {
            $officemain = 'main';
        } else {
            $mainoffice = ClientUser::with('users')->find($Adminusers->suboffice);
            $officemain = $mainoffice->office;
        }


        return view('client.profile_view.client_view', compact('Adminusers', 'sub_office', 'officemain'));
    }

    public function passwordchange(Request $request, $id): JsonResponse
    {

        $userId = $id;
        $responseData = User::find($userId);
        return response()->json(['data' => $responseData]);
    }
    public function passwordupdae(Request $request): RedirectResponse
    {


        $user = User::find($request->id);

        if ($user) {
            $user->update(['password' =>  Hash::make($request->ConfirmPassword)]);
            toastr()->success('Update Password  successfully!');

            return redirect()->back()->with('refresh', now());;
        } else {
            toastr()->error('An error has occurred, please try again later.');

            return redirect()->back();
        }
    }
    public function updateStatus(Request $request): RedirectResponse
    {
        $user = User::find($request->id);

        if ($user) {
            $user->update(['status' => $request->statusupdate]);
            toastr()->success('Update Status  successfully!');

            return redirect()->back()->with('refresh', now());;
        } else {
            toastr()->error('An error has occurred, please try again later.');

            return redirect()->back();
        }
    }
    public function CheckEmailAvailabilityClient(Request $request): JsonResponse
    {

        $emailExists = User::where('email', $request->email)->exists();

        return response()->json(['exists' => $emailExists]);
    }

    public function client_profilecreate_social(Request $request, $id): RedirectResponse
    {

        $id = decrypt($id);
        $adminUser = ClientUser::with('users')->find($id);

        $existingData = [

            'Website' => $adminUser->Website,
            'facebook' => $adminUser->facebook,
            'instagram' => $adminUser->instagram,
            'twitter' => $adminUser->twitter,
        ];

        $changes = array_diff($request->only(['Website', 'facebook', 'instagram', 'twitter']), $existingData);

        if (!empty($changes)) {


            $adminUser->update($changes);
            toastr()->success('Data has been Update successfully!');
            return redirect()->back();
        } else {
            toastr()->info('No Updation');
            return redirect()->back();
        }
    }

    public function client_profilebasic_details(Request $request, $id): RedirectResponse
    {

        $id = decrypt($id);
        $adminUser = ClientUser::with('users')->find($id);
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
    public function client_profilebasic_suboffice(Request $request, $id): RedirectResponse
    {

        $id = decrypt($id);


        if (!empty($request->all())) {

            $adminUser = ClientUser::with('users')->find($id);

            if (($request->officedetails)) {
                foreach ($request->officedetails as $key => $officedetails) {


                        $user = User::create([
                            'name' => $officedetails['Sub_Office_Name'],
                            'email' => $officedetails['email_office'],
                            'password' => Hash::make($officedetails['password_office']),
                            'user_type' => 'user',
                            'status' => '1',
                        ]);

                        $ClientUser = new ClientUser([
                            'firstname' =>  $officedetails['Sub_Office_Name'],
                            'lastname' =>  $officedetails['Sub_Office_Name'],
                            'phonenumber' => $adminUser->phonenumber,
                            'office' => $officedetails['Sub_Office_Name'],
                            'location' => $officedetails['Location'],
                            'suboffice' => $id,
                        ]);

                        $user->clientUser()->save($ClientUser);
                        toastr()->success('Data has been saved successfully!');
                        return redirect()->back();



                }
            }


        } else {
            toastr()->info('No Updation');
            return redirect()->back();
        }
    }

    public function client_profile_main($id): View
    {


        $id = decrypt($id);

        $Adminusers = ClientUser::with('users')->where('user_id',$id)->first();


        $sub_office = ClientUser::with('users')->where('suboffice',$Adminusers->id)->get();

        $officemain = "4gghjgj";
        if (($Adminusers->suboffice) === 'main') {
            $officemain = 'main';
        } else {
            $mainoffice = ClientUser::with('users')->find($Adminusers->suboffice);
            $officemain = $mainoffice->office;
        }


        return view('client.profile_view.client_view', compact('Adminusers', 'sub_office', 'officemain'));

    }
}
