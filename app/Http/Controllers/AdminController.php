<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $applicationCount = \App\Models\Application::count();
        return view('admin.dashboard', compact('applicationCount'));
    }
}
