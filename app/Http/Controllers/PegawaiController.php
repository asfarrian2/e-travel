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
use App\Models\Pelaksana;

class PegawaiController extends Controller
{
    public function view() {

        $pegawai = Pelaksana::where('jenis', '1')->orderby('kelas', 'ASC')->get();

        return view('admin.pegawai.view', compact('pegawai'));
    }

    public function store(Request $request){

        $tahun = date('Y');
        $id_pelaksana = Pelaksana::where('jenis', '1')->whereYear('created_at', $tahun)->latest('id_pelaksana')->first();
        
        $kodeobjek =$tahun."-pl-";

        if($id_pelaksana == null){
            $nomorurut = "0000001";
        }else{
            $nomorurut = substr($id_pelaksana->id_pelaksana, 8, 7) + 1;
            $nomorurut = str_pad($nomorurut, 7, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;
        $nip            = $request->nip;
        $pangkgol       = $request->pangkgol;
        $jabatan        = $request->jabatan;
        $kelas          = $request->kelas;

        $data = [
            'id_pelaksana' => $id,
            'nama'       => $nama,
            'nip'        => $nip,
            'pangkgol'   => $pangkgol,
            'jabatan'    => $jabatan,
            'kelas'      => $kelas,
            'alamat'     => 'BPKUK-Prov Kalsel',
            'kelompok'   => 'BPKUK-Prov Kalsel',
            'jenis'      => '1',
            'status'     => '1'
        ];
        $simpan = Pelaksana::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_pelaksana   = $request->id_pelaksana;
        $id_pelaksana   = Crypt::decrypt($id_pelaksana);

        $pegawai    = Pelaksana::where('id_pelaksana', $id_pelaksana)->first();

        return view('admin.pegawai.edit', compact('pegawai'));

    }

    public function update(Request $request){

        $id_pelaksana   = $request->id;
        $id_pelaksana   = Crypt::decrypt($id_pelaksana);
        $nama         = $request->nama;
        $nip          = $request->nip;
        $pangkgol     = $request->pangkgol;
        $jabatan      = $request->jabatan;

        $data       = [
            'nama'       => $nama,
            'nip'        => $nip,
            'pangkgol'   => $pangkgol,
            'jabatan'    => $jabatan
        ];

        $update = Pelaksana::where('id_pelaksana', $id_pelaksana)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_pelaksana){

        $id_pelaksana   = Crypt::decrypt($id_pelaksana);
        $pegawai      = Pelaksana::where('id_pelaksana', $id_pelaksana)->first();

        $status     = $pegawai->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }else{
            $data = [
                'status' => '0'
            ];
        }

        $update = Pelaksana::where('id_pelaksana',$id_pelaksana)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }

    public function hapus($id_pelaksana){

        $id_pelaksana = Crypt::decrypt($id_pelaksana);

        $delete = Pelaksana::where('id_pelaksana',$id_pelaksana)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}
