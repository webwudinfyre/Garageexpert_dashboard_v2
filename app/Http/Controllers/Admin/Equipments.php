<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Equipments extends Controller
{
    public function view() : View {


        return view('admin.equip.equip_view');

    }
}
