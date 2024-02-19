<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\Routing\Annotation\Route;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Adminuserupdate;
use App\Http\Requests\Admin\techupdate;
use App\Models\AdminUser;
use App\Models\techUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function admin_index(): View
    {

        $Adminusers=AdminUser::with('users')->get();
        return view('admin.registration.admin',compact('Adminusers'));
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



    public function client_index(): View
    {
        return view('admin.registration.client');
    }

    public function tech_index(): View
    {



        $techuser=techUser::with('users')->get();

        return view('admin.registration.tech',compact('techuser'));
    }
    public function tech_create(techupdate $request):  RedirectResponse
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

}
