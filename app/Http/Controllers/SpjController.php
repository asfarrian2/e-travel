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
use Illuminate\Support\Facades\App;
use App\Models\Anggaran;
use App\Models\Pelaksana;
use App\Models\Pelperjadin;
use App\Models\Perjalanan;
use App\Models\Spj;
use App\Models\Subkegiatan;
use App\Models\Subspj;
use App\Models\Tahun;
use App\Models\User;

class SpjController extends Controller
{
    public function pptk_view(){

        $id_user     = Auth::user()->id;
        $id_tahun    = Auth::user()->id_tahun;
        $spj         = Spj::orderby('created_at', 'DESC')->get();
        $subkegiatan = Anggaran::where('id_user', $id_user)->where('id_tahun', $id_tahun)
                      ->get()
                      ->unique('subkegiatan')
                      ->values();

        return view('pptk.spj.view', compact('spj', 'subkegiatan'));

    }


    public function store(Request $request){

        $id_user  = Auth::user()->id;
        $id_tahun = Auth::user()->id_tahun;
        $uraian   = $request->uraian;
        $tgl      = $request->tgl;
        $subkegiatan   = $request->subkegiatan;
        $koderekening  = $request->koderekening;
        $jenis         =  $request->jenis;
        $pengguna      = $request->pengguna;

        $data = [
            'id_user'    => $id_user,
            'id_tahun'   => $id_tahun,
            'uraian'     => $uraian,
            'id_subkegiatan'     => $subkegiatan,
            'id_rekening'     => $koderekening, 
            'tgl'        => $tgl,
            'jenis'      => $jenis,
            'pengguna'   => $pengguna,
            'status'     => '1'
        ];
        $simpan = Spj::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

     //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_spj   = $request->id_spj;
        $id_spj   = Crypt::decrypt($id_spj);
        $id_user     = Auth::user()->id;
        $id_tahun    = Auth::user()->id_tahun;

        $spj      = Spj::where('id_spj', $id_spj)->first();

        $subkegiatan = Anggaran::where('id_user', $id_user)->where('id_tahun', $id_tahun)
                      ->get()
                      ->unique('subkegiatan')
                      ->values();

        return view('pptk.spj.edit', compact('spj', 'subkegiatan'));

    }

    public function update(Request $request){

        $id_spj        = Crypt::decrypt($request->id);
        $uraian        = $request->uraian;
        $tgl           = $request->tgl;
        $subkegiatan   = $request->subkegiatan;
        $koderekening  = $request->koderekening;
        $jenis         =  $request->jenis;
        $pengguna      = $request->pengguna;

        $data = [
            'uraian'     => $uraian,
            'id_subkegiatan'  => $subkegiatan,
            'id_rekening'     => $koderekening, 
            'tgl'        => $tgl,
            'jenis'      => $jenis,
            'pengguna'   => $pengguna,
        ];
        $update = Spj::where('id_spj', $id_spj)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah.']);
        }

    }

    public function pptk_subspj($id_spj){

        $id_user     = Auth::user()->id;
        $id_tahun    = Auth::user()->id_tahun;
        $id_spj      = Crypt::decrypt($id_spj);

        //Data Detail SPJ
        $spj         = Spj::where('id_spj', $id_spj)->first();

        $subspj      = Subspj::where('id_spj', $spj->id_spj)->get();
                        // Tambahkan total per subspj
                        $subspj->each(function($item) {
                            $item->total_realisasi = DB::table('tb_realisasi')
                                ->where('id_subspj', $item->id_subspj)
                                ->sum('nilai');
                        });
                        // Hitung total keseluruhan untuk SPJ
                        $spj->total_realisasi = $subspj->sum('total_realisasi');

        // Ambil semua id_perjalanan dari subspj
        $id_perjalanan = $subspj->pluck('id_perjalanan');

        $totals = Pelperjadin::whereIn('id_perjalanan', $id_perjalanan)
                    ->selectRaw('
                        id_perjalanan,
                        COALESCE(SUM(uang_harian),0) as total_harian,
                        COALESCE(SUM(uang_transport),0) as total_transport,
                        COALESCE(SUM(uang_penginapan),0) as total_penginapan
                    ')
                    ->groupBy('id_perjalanan')
                    ->get()
                    ->keyBy('id_perjalanan');


        return view('pptk.spj.sub.view', compact('spj', 'subspj', 'totals' ));

    }

 public function add_perjalanan(Request $request)
 {
     $id_spj = Crypt::decrypt($request->id_spj);
 
     $spj = Spj::where('id_spj', $id_spj)->first();
 
     // Ambil semua id_perjalanan yang sudah masuk sub_spj
     $sudahDipakai = SubSpj::pluck('id_perjalanan');
 
     $perjalanan = Perjalanan::where('jenis', $spj->jenis)
         ->where('status', 3)
         ->where('pengguna', $spj->pengguna)
         ->whereNotIn('id_perjalanan', $sudahDipakai)
         ->whereHas('anggaran', function ($q) use ($spj) {
 
             $q->where('id_subkegiatan', $spj->id_subkegiatan)
               ->where('id_rekening', $spj->id_rekening);
 
         })
         ->get();
 
     return view('pptk.spj.sub.add', compact('perjalanan'));
 }

public function simpanPerjalanan(Request $request)
    {
        try {
    
            DB::beginTransaction();
    
            $id_spj = Crypt::decrypt($request->id_spj);
    
            foreach ($request->perjalanan_id as $id_perjalanan) {
    
                $id_perjalanan = Crypt::decrypt($id_perjalanan);
    
                Subspj::firstOrCreate(
                    [
                        'id_spj' => $id_spj,
                        'id_perjalanan'  => $id_perjalanan,
                    ]
                );
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Data perjalanan pada SPJ berhasil disimpan'
            ]);
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    
}
