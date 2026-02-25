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
use App\Models\Subkegiatan;
use App\Models\Koderekening;
use App\Models\RincAnggaran;

class AnggaranController extends Controller
{
    public function view() {

        $id_user      = Auth::user()->id;
        $id_tahun     = Auth::user()->id_tahun;
        $subkegiatan  = Subkegiatan::orderby('kd_subkegiatan', 'ASC')->get();
        $koderekening = Koderekening::all();
        $anggaran     = Anggaran::with([
                            'subkegiatan',
                            'rekening',
                            'rincian'
                        ])
                        ->where('id_user', $id_user)->where('id_tahun', $id_tahun)
                        ->orderBy('id_subkegiatan')->orderBy('id_rekening')->orderBy('nm_anggaran')->orderBy('sub_anggaran')
                        ->get()
                        ->groupBy([
                            'id_subkegiatan',
                            'id_rekening',
                            'nm_anggaran',
                            'sub_anggaran'
                        ]);


        return view('pptk.anggaran.view', compact('anggaran', 'koderekening', 'subkegiatan'));
    }

    public function store(Request $request){

        $id_user      = Auth::user()->id;
        $id_tahun     = Auth::user()->id_tahun;

        $id_anggaran = Anggaran::where('id_tahun', $id_tahun)->latest('id_anggaran')->first();

        $kodeobjek ="ang".$id_tahun;

        if($id_anggaran == null){
            $nomorurut = "000001";
        }else{
            $nomorurut = substr($id_anggaran->id_anggaran, 9, 6) + 1;
            $nomorurut = str_pad($nomorurut, 6, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $subkegiatan     = $request->subkegiatan;
        $subkegiatan     = Crypt::decrypt($subkegiatan);
        $koderekening    = $request->koderekening;
        $koderekening    = Crypt::decrypt($koderekening);
        $nm_anggaran     = $request->nm_anggaran;
        $sub_anggaran    = $request->sub_anggaran;

        $data = [
            'id_anggaran'    => $id,
            'id_subkegiatan' => $subkegiatan,
            'id_rekening'    => $koderekening,
            'nm_anggaran'    => $nm_anggaran,
            'sub_anggaran'   => $sub_anggaran,
            'id_user'        => $id_user,
            'id_tahun'       => $id_tahun,
            'status'         => '0'
        ];
        $simpan = Anggaran::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_anggaran   = $request->id_anggaran;
        $id_anggaran   = Crypt::decrypt($id_anggaran);
        $subkegiatan   = Subkegiatan::orderby('kd_subkegiatan', 'ASC')->get();
        $koderekening  = Koderekening::all();

        $anggaran    = Anggaran::where('id_anggaran', $id_anggaran)->first();

        return view('pptk.anggaran.edit', compact('anggaran', 'subkegiatan', 'koderekening'));

    }

    public function update(Request $request){

        $id_anggaran     = $request->id;
        $id_anggaran     = Crypt::decrypt($id_anggaran);
        $subkegiatan     = $request->subkegiatan;
        $subkegiatan     = Crypt::decrypt($subkegiatan);
        $koderekening    = $request->koderekening;
        $koderekening    = Crypt::decrypt($koderekening);
        $nm_anggaran     = $request->nm_anggaran;
        $sub_anggaran    = $request->sub_anggaran;

        $data       = [
            'id_subkegiatan' => $subkegiatan,
            'id_rekening'    => $koderekening,
            'nm_anggaran'    => $nm_anggaran,
            'sub_anggaran'   => $sub_anggaran
        ];

        $update = Anggaran::where('id_anggaran', $id_anggaran)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function hapus($id_anggaran){
        $id_anggaran = Crypt::decrypt($id_anggaran);
        $cekAnggaran = RincAnggaran::where('id_anggaran', $id_anggaran)->first();
        if ($cekAnggaran) {
            return Redirect::back()->with(['warning' => 'Tidak dapat menghapus anggaran, karena data sedang digunakan']);
        } else {
            $delete = Anggaran::where('id_anggaran', $id_anggaran)->delete();
            if ($delete) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
        }
    }

}
