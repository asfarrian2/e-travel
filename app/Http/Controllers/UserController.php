<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelaksana;

class UserController extends Controller
{
    public function view(){

        $users   = User::whereNot('role', 'admin')->orderBy('role', 'ASC')->get();
        $pegawai = Pelaksana::where('status', '1')->where('jenis', '1')->orderby('kelas', 'ASC')->get();

        return view('admin.users.view', compact('users', 'pegawai'));
    }

    public function store(Request $request){

        $pegawai  = $request->pegawai;
        $pegawai  = crypt::decrypt($pegawai);
        $nickname = $request->nickname;
        $email    = $request->email;
        $profile  = $request->profile;   
        $password = $request->password;
        $role     = $request->role;

        $data = [
            'id_pelaksana' => $pegawai,
            'nickname'   => $nickname,
            'email'      => $email,
            'profile'    => $profile,
            'password'   => Hash::make($password),
            'role'       => $role
        ];
        $simpan = User::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    public function edit(Request $request){

        $id      = $request->id;
        $id      = Crypt::decrypt($id);
        $user   = User::where('id', $id)->first();
        $pegawai = Pelaksana::where('status', '1')->where('jenis', '1')->orderby('kelas', 'ASC')->get();

        return view('admin.users.edit', compact('user', 'pegawai'));
    }

    public function update(Request $request){

        $id       = $request->id;
        $id       = Crypt::decrypt($id);
        $pegawai  = $request->pegawai;
        $pegawai  = Crypt::decrypt($pegawai);
        $nickname = $request->nickname;
        $email    = $request->email;
        $profile  = $request->profile;        

        if ($request->password) {
        $data       = [
            'id_pelaksana'    => $pegawai,
            'nickname'   => $nickname,
            'email'      => $email,
            'password'   => $request->password,
            'profile'    => $profile,
        ];
        }else{
             $data       = [
            'id_pelaksana'    => $pegawai,
            'nickname'   => $nickname,
            'email'      => $email,
            'profile'    => $profile,
        ];
        }

        $update = User::where('id', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function hapus($id){
        
        $id = Crypt::decrypt($id);

        $cekAnggaran = Anggaran::where('id_user', $id)->first();
        if ($cekAnggaran) {
              return Redirect::back()->with(['warning' => 'Tidak dapat menghapus data']);
          } else {
            $delete = User::where('id', $id)->delete();
            if ($delete) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
        }
        
    }


}
