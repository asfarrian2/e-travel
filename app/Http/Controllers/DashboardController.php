<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // -*Halaman Admin- 
    public function admin_view(){

        return view('admin.dashboard.view');
        
    }

    // -*Halaman PPTK- 
    public function pptk_view(){

        $id_user      = Auth::user()->id;
        $id_tahun     = Auth::user()->id_tahun;

        $totalAnggaran = Anggaran::where('id_user', $id_user)
                    ->where('id_tahun', $id_tahun)
                    ->withSum('rincian as total', DB::raw('harga * volume'))
                    ->get()
                    ->sum('total');

        return view('pptk.dashboard.view', compact('totalAnggaran'));
        
    }

    // -*Halaman KPA- 
    public function kpa_view(){

        $id_tahun     = Auth::user()->id_tahun;

        $totalAnggaran = Anggaran::where('id_tahun', $id_tahun)
                    ->withSum('rincian as total', DB::raw('harga * volume'))
                    ->get()
                    ->sum('total');

        return view('kpa.dashboard.view', compact('totalAnggaran'));
        
    }

}
