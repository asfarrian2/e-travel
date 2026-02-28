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
use App\Models\Subkegiatan;

class SubkegiatanController extends Controller
{
    public function view() {

        $subkegiatan = Subkegiatan::orderby('kd_subkegiatan', 'ASC')->get();

        return view('admin.subkegiatan.view', compact('subkegiatan'));
    }

    public function store(Request $request){

        $subkegiatan     = $request->subkegiatan;
        $kodesubkegiatan = $request->kodesubkegiatan;

        $data = [
            'nm_subkegiatan' => $subkegiatan,
            'kd_subkegiatan' => $kodesubkegiatan,
            'status'         => '1'
        ];
        $simpan = Subkegiatan::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_subkegiatan   = $request->id_subkegiatan;
        $id_subkegiatan   = Crypt::decrypt($id_subkegiatan);

        $subkegiatan    = Subkegiatan::where('id_subkegiatan', $id_subkegiatan)->first();

        return view('admin.subkegiatan.edit', compact('subkegiatan'));

    }

    public function update(Request $request){

        $id_subkegiatan   = $request->id;
        $id_subkegiatan   = Crypt::decrypt($id_subkegiatan);
        $subkegiatan      = $request->subkegiatan;
        $kodesubkegiatan  = $request->kodesubkegiatan;

        $data       = [
            'nm_subkegiatan'     => $subkegiatan,
            'kd_subkegiatan'     => $kodesubkegiatan
        ];

        $update = Subkegiatan::where('id_subkegiatan', $id_subkegiatan)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_subkegiatan){

        $id_subkegiatan   = Crypt::decrypt($id_subkegiatan);
        $subkegiatan      = Subkegiatan::where('id_subkegiatan', $id_subkegiatan)->first();

        $status     = $subkegiatan->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }else{
            $data = [
                'status' => '0'
            ];
        }

        $update = subkegiatan::where('id_subkegiatan',$id_subkegiatan)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }


    public function hapus($id_subkegiatan){

        $id_subkegiatan = Crypt::decrypt($id_subkegiatan);

        $delete = Subkegiatan::where('id_subkegiatan',$id_subkegiatan)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

    
}
