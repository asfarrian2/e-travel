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
use App\Models\Anggaran;
use App\Models\Tahun;
use App\Models\RincAnggaran;
use Illuminate\Support\Facades\Request as FacadesRequest;

class RincanggaranController extends Controller
{
    public function add(Request $request){

        $id_anggaran   = $request->id_anggaran;
        $id_anggaran   = Crypt::decrypt($id_anggaran);
        $anggaran      = Anggaran::where('id_anggaran', $id_anggaran)->first();

        return view('pptk.rincanggaran.add', compact('anggaran'));

    }

    public function store(Request $request){

        $id_anggaran     = $request->id;
        $id_anggaran     = Crypt::decrypt($id_anggaran);
        $jenis           = $request->jenis;
        $kegunaan        = $request->kegunaan;
        $uraian          = $request->uraian;
        $spesifikasi     = $request->spesifikasi;
        $harga           = $request->harga;
        $harga           = str_replace('.', '', $harga);
        $volume          = $request->volume;
        $satuan          = $request->satuan;


        $data = [
            'id_anggaran' => $id_anggaran,
            'jenis' => $jenis,
            'kegunaan' => $kegunaan,
            'uraian' => $uraian,
            'spesifikasi' => $spesifikasi,
            'harga' => $harga,
            'volume' => $volume,
            'satuan' => $satuan,
        ];
        $simpan = RincAnggaran::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_rincanggaran   = $request->id_rincanggaran;
        $id_rincanggaran   = Crypt::decrypt($id_rincanggaran);

        $rincanggaran    = RincAnggaran::where('id_rincanggaran', $id_rincanggaran)->first();

        return view('pptk.rincanggaran.edit', compact('rincanggaran'));

    }

     public function update(Request $request){

        $id_rincanggaran = $request->id;
        $id_rincanggaran = Crypt::decrypt($id_rincanggaran);
        $jenis           = $request->jenis;
        $kegunaan        = $request->kegunaan;
        $uraian          = $request->uraian;
        $spesifikasi     = $request->spesifikasi;
        $harga           = $request->harga;
        $harga           = str_replace('.', '', $harga);
        $volume          = $request->volume;
        $satuan          = $request->satuan;

        $data       = [
            'jenis' => $jenis,
            'kegunaan' => $kegunaan,
            'uraian' => $uraian,
            'spesifikasi' => $spesifikasi,
            'harga' => $harga,
            'volume' => $volume,
            'satuan' => $satuan
        ];

        $update = RincAnggaran::where('id_rincanggaran', $id_rincanggaran)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function hapus($id_rincanggaran){
        $id_rincanggaran = Crypt::decrypt($id_rincanggaran);
        
            $delete = RincAnggaran::where('id_rincanggaran', $id_rincanggaran)->delete();
            if ($delete) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
        
    }

}
