<?php

namespace App\Http\Controllers\tech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index() : View{
        return view('tech.dashboard.index');
    }
}
