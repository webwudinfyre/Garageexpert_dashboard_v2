<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\Routing\Annotation\Route;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Adminuserupdate;
use App\Http\Requests\Admin\clientuserupdate;
use App\Http\Requests\Admin\techupdate;
use App\Models\AdminUser;
use App\Models\ClientUser;
use App\Models\techUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function admin_index(): View
    {

        $Adminusers = AdminUser::with('users')->get();
        // $posts = AdminUser::all();
        // $Adminusers = AdminUser::with(['users' => function ($query) {
        //     $query->orderByStatus('asc');
        // }])->get();

        return view('admin.registration.admin', compact('Adminusers'));
    }
    public function admin_create(Adminuserupdate $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->First_Name . ' ' . $request->Last_Name,
                'email' => $request->Email,
                'password' => Hash::make($request->Password),
                'user_type' => 'Admin',
                'status' => '1',
            ]);

            $adminuser = new AdminUser([
                'firstname' => $request->First_Name,
                'lastname' => $request->Last_Name,
                'phonenumber' => $request->Phone_number,
            ]);

            $user->adminUser()->save($adminuser);
            DB::commit();

            toastr()->success('Data has been saved successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error('An error has occurred, please try again later.');
            return redirect()->back();
        }
    }

    public function admin_profile($id): view
    {
        $id = decrypt($id);
        $Adminusers = AdminUser::with('users')->find($id);

        return view('admin.profile_view.admin_view', compact('Adminusers'));
    }
    public function admin_profilecreate_social(Request $request, $id): RedirectResponse
    {

        $id = decrypt($id);
        $adminUser = AdminUser::with('users')->find($id);

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

    public function admin_profilebasic_details(Request $request, $id): RedirectResponse
    {

        $id = decrypt($id);
        $adminUser = AdminUser::with('users')->find($id);
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

    public function admin_profile_main($id): view
    {
        $id = decrypt($id);

        $Adminusers = AdminUser::with('users')->where('user_id',$id)->first();

        return view('admin.profile_view.admin_view', compact('Adminusers'));
    }
    // public function view_create()
    // {

    //     return view('admin.registration.modal_post');
    // }

    public function showModal($postId): view
    {
        $post = AdminUser::find($postId);
        print_r("hI");
        die();
        return view('admin.registration.modal_post', compact('post'));
    }
//-------------------------------------client -------------------------------------//
    public function client_index(): View
    {
        $ClientUser_count = ClientUser::where('suboffice', 'main')->with('users')->get();

        $clientData = [];
        foreach ($ClientUser_count as $clientUser) {
            $subofficeCounts = ClientUser::where('suboffice', $clientUser->id)->groupBy('suboffice')->count();
            $suboffice = ClientUser::where('suboffice', $clientUser->id)->with('users')->get();
            $clientData[] = [

                'client' => $clientUser,
                'suboffice_count' => $subofficeCounts,
                'suboffice' => $suboffice,
            ];
        }
        // $jsonData = json_encode($clientData, JSON_PRETTY_PRINT);

        // // Save the JSON data to a file
        // file_put_contents('client_data.json', $jsonData);

        // // Print the JSON data (optional)
        // echo $jsonData;
        // die();
        return view('admin.registration.client', compact('clientData'));
    }
    public function client_create(clientuserupdate $request): RedirectResponse
    {
        $validator = $request->validate([
            'officedetails.*.Sub_Office_Name' => 'required|string|max:255',
            'officedetails.*.Location' => 'required|string|max:255',
            'officedetails.*.email_office' => 'required|email|max:255|unique:users,email',
            
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->First_Name . ' ' . $request->Last_Name,
                'email' => $request->Email,
                'password' => Hash::make($request->Password),
                'user_type' => 'user',
                'status' => '1',
            ]);

            $ClientUser = new ClientUser([
                'firstname' => $request->First_Name,
                'lastname' => $request->Last_Name,
                'phonenumber' => $request->Phone_number,
                'office' => $request->Office_Name,
                'location' => $request->Main_Location,
                'suboffice' => 'main',
            ]);

            $user->clientUser()->save($ClientUser);

            $ClientUser_id = $ClientUser->id;
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
                        'phonenumber' => $request->Phone_number,
                        'office' => $officedetails['Sub_Office_Name'],
                        'location' => $officedetails['Location'],
                        'suboffice' => $ClientUser_id,
                    ]);

                    $user->clientUser()->save($ClientUser);
                }
            }
            DB::commit();

            toastr()->success('Data has been saved successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error('An error has occurred, please try again later.');
            return redirect()->back();
        }
    }

    public function CheckEmailAvailabilityClient(Request $request): JsonResponse
    {

        $emailExists = User::where('email', $request->email)->exists();

        return response()->json(['exists' => $emailExists]);
    }



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


        return view('admin.profile_view.client_view', compact('Adminusers', 'sub_office', 'officemain'));
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

    public function client_profile_main($id): view
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
// }

    //------------------------------------------tech-------------------------------------//

    public function tech_index(): View
    {



        $techuser = techUser::with('users')->get();

        return view('admin.registration.tech', compact('techuser'));
    }
    public function tech_create(Request $request): RedirectResponse
    {


        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->First_Name . ' ' . $request->Last_Name,
                'email' => $request->Email,
                'password' => Hash::make($request->Password),
                'user_type' => 'tech',
                'status' => '1',
            ]);

            $techuser = new techUser([
                'firstname' => $request->First_Name,
                'lastname' => $request->Last_Name,
                'phonenumber' => $request->Phone_number,
            ]);

            $user->techUser()->save($techuser);
            DB::commit();

            toastr()->success('Data has been saved successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error('An error has occurred, please try again later.');
            return redirect()->back();
        }
    }


    public function tech_profile($id): view
    {
        $id = decrypt($id);
        $Adminusers = techUser::with('users')->find($id);

        return view('admin.profile_view.tech_view', compact('Adminusers'));
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

    //-------------------------------------------------------------------------------------------//
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
}
