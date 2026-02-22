<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // -*Halaman Admin- 
    public function admin_view(){

        return view('admin.dashboard.view');
        
    }
}
