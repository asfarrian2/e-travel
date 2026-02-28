<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Tahun;

class TahunController extends Controller
{
    public function view(){

        $tahun = Tahun::all();

        return view('admin.tahun.view', compact('tahun', 'tahun'));
    }

    public function store(Request $request){

        $tahun     = $request->tahun;
        $dpa       = $request->dpa;
        $tgl       = $request->tgl;

        $data = [
            'tahun'    => $tahun,
            'dpa'      => $dpa,
            'tgl_dpa'  => $tgl,
            'status'   => '1'
        ];
        $simpan = Tahun::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_tahun   = $request->id_tahun;
        $id_tahun   = Crypt::decrypt($id_tahun);

        $tahun    = Tahun::where('id_tahun', $id_tahun)->first();

        return view('admin.tahun.edit', compact('tahun'));

    }

    public function update(Request $request){

        $id_tahun   = $request->id;
        $id_tahun   = Crypt::decrypt($id_tahun);
        $tahun      = $request->tahun;
        $dpa       = $request->dpa;
        $tgl       = $request->tgl;

        $data       = [
            'tahun'    => $tahun,
            'dpa'      => $dpa,
            'tgl_dpa'  => $tgl,
        ];

        $update = Tahun::where('id_tahun', $id_tahun)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_tahun){

        $id_tahun   = Crypt::decrypt($id_tahun);
        $tahun      = Tahun::where('id_tahun', $id_tahun)->first();

        $status     = $tahun->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }else{
            $data = [
                'status' => '0'
            ];
        }

        $update = Tahun::where('id_tahun',$id_tahun)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }


    public function hapus($id_tahun){

        $id_tahun = Crypt::decrypt($id_tahun);
        
        // Jika tidak ada DPA yang terkait, maka hapus data tahun
        $delete = Tahun::where('id_tahun', $id_tahun)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Tahun Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Tahun Gagal Dihapus']);
        }
    }

}
