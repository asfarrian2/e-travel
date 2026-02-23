<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tahun;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function view(){

        $tahun = Tahun::where('status', '1')->get();

        return view('auth.view', compact('tahun'));
        
    }
    public function login(Request $request)
    {
    $credentials = [
        'email' => $request->email,
        'password' => $request->password
    ];

    if (Auth::attempt($credentials)) {
        $redirectUrls = [
            'admin' => '/admin/dashboard',
            'kpa' => '/pa-dashboard',
            'bpp' => '/bp-dashboard',
            'pptk' => '/dashboard',
        ];

        $id_tahun = Crypt::decrypt($request->tahun);
         $data = [
                'id_tahun' => $id_tahun
            ];

        User::where('email', $request->email)->update($data)
        ;
        return redirect($redirectUrls[Auth::user()->role]);
    }

    return redirect('/')->with(['warning' => 'Email / Password Salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
