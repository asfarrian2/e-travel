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
use App\Models\Realisasi;
use App\Models\RincAnggaran;
use App\Models\Spj;
use App\Models\Subkegiatan;
use App\Models\Subspj;
use App\Models\Tahun;
use App\Models\User;

class RincianspjController extends Controller
{
    public function formUangharian(Request $request)
    {
        $id_perjalanan = Crypt::decrypt($request->id_perjalanan);
        $id_subspj     = Crypt::decrypt($request->id_subspj);
        $perjalanan    = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();
        $pelperjadin   = Pelperjadin::where('id_perjalanan', $id_perjalanan)->get();
        $rincanggaran  = RincAnggaran::where('id_anggaran', $perjalanan->id_anggaran)
                         ->where('jenis', $perjalanan->jenis)->where('kegunaan', 'Uang Harian')
                         ->get();

        return view('pptk.spj.sub.add.uangharian', compact('pelperjadin', 'rincanggaran', 'id_subspj'));
    }

    public function simpanUangharian(Request $request)
    {
    $id_rincanggaran = Crypt::decrypt($request->id_rincanggaran);
    $id_subspj       = Crypt::decrypt($request->subspj);
    $nilai = str_replace('.', '', $request->nilai);
    $kegunaan = $request->kegunaan;
    $volume   = $request->volume;

    if(!$request->pelperjadin){
        return response()->json([
            'error' => 'Tidak ada pelaksana dipilih'
        ],422);
    }

    foreach ($request->pelperjadin as $id_pelperjadin) {

        // update uang harian di pelperjadin
        Pelperjadin::where('id_pelperjadin',$id_pelperjadin)
        ->update([
            'uang_harian' => $nilai
        ]);

        // jika sudah ada -> update
        // jika belum ada -> create
        Realisasi::updateOrCreate(

            [
                'id_pelperjadin' => $id_pelperjadin,
                'kegunaan' => $kegunaan
            ],

            [
                'id_rincanggaran' => $id_rincanggaran,
                'id_subspj' => $id_subspj,
                'nilai' => $nilai,
                'volume' => $volume
            ]

        );

    }

    return response()->json([
        'success'=>true
    ]);
}

}
