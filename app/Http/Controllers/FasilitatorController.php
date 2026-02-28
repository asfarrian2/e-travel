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
use App\Models\Pelperjadin;

class FasilitatorController extends Controller
{
     public function view() {

        $pelaksana = Pelaksana::where('jenis', '2')->orderby('kelas', 'ASC')->get();

        return view('admin.fasilitator.view', compact('pelaksana'));
    }

    public function pptk_view() {

        $pelaksana = Pelaksana::where('jenis', '2')->get();

        return view('pptk.fasilitator.view', compact('pelaksana'));
    }   

    public function store(Request $request){

        $nama           = $request->nama;
        $nip            = $request->nip;
        $pangkgol       = $request->pangkgol;
        $jabatan        = $request->jabatan;
        $alamat         = $request->alamat;

        $data = [
            'nama'       => $nama,
            'nip'        => $nip,
            'pangkgol'   => $pangkgol,
            'jabatan'    => $jabatan,
            'kelas'      => '0',
            'alamat'     => $alamat,
            'kelompok'   => 'Fasilitator',
            'jenis'      => '2',
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

        $pelaksana    = Pelaksana::where('id_pelaksana', $id_pelaksana)->first();

        return view('pptk.fasilitator.edit', compact('pelaksana'));

    }

    public function update(Request $request){

        $id_pelaksana   = $request->id;
        $id_pelaksana   = Crypt::decrypt($id_pelaksana);
        $nama           = $request->nama;
        $nip            = $request->nip;
        $pangkgol       = $request->pangkgol;
        $jabatan        = $request->jabatan;
        $alamat         = $request->alamat;

        $data       = [
            'nama'       => $nama,
            'nip'        => $nip,
            'pangkgol'   => $pangkgol,
            'jabatan'    => $jabatan,
            'alamat'     => $alamat
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

        $cekData = Pelperjadin::where('id_pelaksana', $id_pelaksana)->first();
        if ($cekData) {
              return Redirect::back()->with(['warning' => 'Tidak dapat menghapus data']);
          } else {
            $delete = Pelaksana::where('id_pelaksana',$id_pelaksana)->delete();

            if ($delete) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
        }
    }

}
