<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Action
    public function index(){
        return view('dashboard.index');
    }
    public function orders(){
        return view('dashboard.order');
    }


    public function settings(){
        return view('dashboard.setting');
    }
}
