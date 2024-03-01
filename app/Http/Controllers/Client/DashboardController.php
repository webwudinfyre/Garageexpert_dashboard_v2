<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index() : View{
        return view('client.dashboard.index');
    }
}
