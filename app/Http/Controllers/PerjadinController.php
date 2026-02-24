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
use App\Models\Perjalanan;
use App\Models\Tahun;

class PerjadinController extends Controller
{
    public function viewd(Request $request)
    {
        $user  = Auth::user();

        $tahun  = Tahun::where('id_tahun', $user->id_tahun)->first();
        $ytahun = $tahun->tahun;

        if (!$request->jenis) {
            return view('pptk.perjadin.view', [
                'hapus'  => collect(),
                'draft'  => collect(),
                'disetujui'=> collect(),
                'ditolak'=> collect(),
                'ytahun' => $ytahun
            ]);
        }

        $baseQuery = Perjalanan::where('jenis', $request->jenis)
            ->where('id_tahun', $user->id_tahun)
            ->where('id_user', $user->id);

        $hapus  = (clone $baseQuery)->where('status', '0')->get(); // hapus
        $draft  = (clone $baseQuery)->whereIn('status', ['1', '2'])->get(); // draft
        $disetujui  = (clone $baseQuery)->where('status', '3')->get(); // disetujui
        $ditolak  = (clone $baseQuery)->where('status', '4')->get(); // ditolak

        return view('pptk.perjadin.view', compact('hapus', 'draft', 'disetujui', 'ditolak', 'ytahun'));
    }

    public function store(Request $request){

        $id_user  = Auth::user()->id;
        $id_tahun = Auth::user()->id_tahun;
        $tahun    = Tahun::where('id_tahun', $id_tahun)->first();

        $id_perjalanan = Perjalanan::whereYear('created_at', $tahun->tahun)->latest('id_perjalanan')->first();
        
        $kodeobjek ="pt".$tahun->tahun;

        if($id_perjalanan == null){
            $nomorurut = "000000001";
        }else{
            $nomorurut = substr($id_perjalanan->id_perjalanan, 6, 9) + 1;
            $nomorurut = str_pad($nomorurut, 9, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;
        
        $dasar          = $request->dasar;
        $keperluan      = $request->keperluan;
        $tujuan         = $request->tujuan;
        $tgl_berangkat  = $request->tgl_berangkat;
        $tgl_pulang     = $request->tgl_pulang;
        $angkutan       = $request->angkutan;
        $jenis          = $request->jenis;

        $data = [
            'id_perjalanan'=> $id,
            'id_user'      => $id_user,
            'id_tahun'     => $id_tahun,
            'dasar'        => $dasar,
            'keperluan'    => $keperluan,
            'tujuan'       => $tujuan,
            'tgl_berangkat'=> $tgl_berangkat,
            'tgl_pulang'   => $tgl_pulang,
            'angkutan'     => $angkutan,
            'jenis'        => $jenis,
            'pengguna'     => '1',
            'status'       => '1'
        ];
        $simpan = Perjalanan::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    public function edit(Request $request){

        return view('pptk.perjadin.edit');
    }

}
