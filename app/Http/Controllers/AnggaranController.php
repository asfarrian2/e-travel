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
use App\Models\Tahun;
use App\Models\User;

class AnggaranController extends Controller
{
    //------------------------------AKSES PPTK------------------------------
    public function pptk_view() {

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
        
        $totalAnggaran = Anggaran::where('id_user', $id_user)
                         ->where('id_user', $id_user)
                         ->where('id_tahun', $id_tahun)
                         ->withSum('rincian as total', DB::raw('harga * volume'))
                         ->get()
                         ->sum('total');

        $tahun         = Tahun::where('id_tahun', $id_tahun)->first();
        $users         = User::where('id', $id_user)->first();

        return view('pptk.anggaran.view', compact('anggaran', 'koderekening', 'subkegiatan', 'totalAnggaran', 'tahun', 'users'));
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

    public function simpan($id_user){

        $id      = Crypt::decrypt($id_user);
        $users   = User::where('id', $id)->first();
        $id_tahun= Auth::user()->id_tahun;

        $status     = $users->jdwl_anggaran;

        if($status == 0){
            $data = [
                'jdwl_anggaran' => $id_tahun
            ];
        }else{
            $data = [
                'jdwl_anggaran' => '0'
            ];
        }

        $update = User::where('id',$id)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }


    //------------------------------AKSES KPA------------------------------
    public function kpa_view() {

        $id_tahun     = Auth::user()->id_tahun;
        $users        = User::with(['pegawai'])->where('role', 'pptk')
                        ->withSum(['anggaran as total_anggaran' => function ($q) use($id_tahun) {
                             $q->where('tb_anggaran.id_tahun', $id_tahun)->join('tb_rincanggaran', 'tb_anggaran.id_anggaran', '=', 'tb_rincanggaran.id_anggaran');
                        }], DB::raw('tb_rincanggaran.harga * tb_rincanggaran.volume'))
                        ->get();

        $tahun         = Tahun::where('id_tahun', $id_tahun)->first();

        return view('kpa.anggaran.view', compact('users', 'tahun'));
    }

    public function data_kpa($id) {

        $id_user      = Crypt::decrypt($id);
        $users        = User::where('id', $id_user)->first();
        $id_tahun     = Auth::user()->id_tahun;
        $subkegiatan  = Subkegiatan::orderby('kd_subkegiatan', 'ASC')->get();
        $koderekening = Koderekening::all();
        $anggaran     = Anggaran::with([
                            'subkegiatan',
                            'rekening',
                            'rincian'
                        ])
                        ->where('id_user', $id_user)
                        ->where('id_tahun', $id_tahun)
                        ->orderBy('id_subkegiatan')->orderBy('id_rekening')->orderBy('nm_anggaran')->orderBy('sub_anggaran')
                        ->get()
                        ->groupBy([
                            'id_subkegiatan',
                            'id_rekening',
                            'nm_anggaran',
                            'sub_anggaran'
                        ]);
        
        $totalAnggaran = Anggaran::where('id_tahun', $id_tahun)
                         ->where('id_user', $id_user)
                         ->withSum('rincian as total', DB::raw('harga * volume'))
                         ->get()
                         ->sum('total');

        $tahun         = Tahun::where('id_tahun', $id_tahun)->first();

        return view('kpa.anggaran.detail', compact('anggaran', 'koderekening', 'subkegiatan', 'totalAnggaran', 'tahun', 'users'));
    }


    public function akses($id){

        $id      = Crypt::decrypt($id);
        $users   = User::where('id', $id)->first();
        $id_tahun= Auth::user()->id_tahun;

        $status     = $users->jdwl_anggaran;

        if($status == 0){
            $data = [
                'jdwl_anggaran' => $id_tahun
            ];
        }else{
            $data = [
                'jdwl_anggaran' => '0'
            ];
        }

        $update = User::where('id',$id)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }

}
