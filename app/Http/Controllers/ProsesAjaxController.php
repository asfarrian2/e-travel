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
use App\Models\Pelaksana;
use App\Models\Pelperjadin;
use App\Models\Perjalanan;
use App\Models\Tahun;

class ProsesAjaxController extends Controller
{

    public function getAnggaran(Request $request)
    {
        $search = $request->q;

        $data = Anggaran::where('nm_anggaran', 'like', "%$search%")
            ->select('nm_anggaran')
            ->distinct()
            ->limit(10)
            ->get();

        return response()->json(
            $data->map(function ($item) {
                return [
                    'id' => $item->nm_anggaran,
                    'text' => $item->nm_anggaran
                ];
            })
        );
    }

    public function getSubAnggaran(Request $request)
    {
        $search = $request->q;

        $data = Anggaran::where('sub_anggaran', 'like', "%$search%")
            ->select('sub_anggaran')
            ->distinct()
            ->limit(10)
            ->get();

        return response()->json(
            $data->map(function ($item) {
                return [
                    'id' => $item->sub_anggaran,
                    'text' => $item->sub_anggaran
                ];
            })
        );
    }

    public function getPerjKodeRekening(Request $request)
    {
        try {

            $id_sub = Crypt::decrypt($request->id_subkegiatan);

            $data = Anggaran::with('rekening')
                    ->where('id_subkegiatan', $id_sub)
                    ->where('id_user', Auth::user()->id)
                    ->where('id_tahun', Auth::user()->id_tahun)
                    ->get()
                    ->unique('id_rekening')
                    ->values();

            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public function getPerjAnggaran(Request $request)
    {
        try {
            $id_perjalanan = $request->id_perjalanan;
            $perjalanan = Perjalanan::where('id_perjalanan', Crypt::decrypt($id_perjalanan))->first();
            $jenis      = $perjalanan->jenis; 
    
            $id_sub = Crypt::decrypt($request->id_subkegiatan);
            $id_rek = $request->id_rekening;
    
            $data = Anggaran::where('id_subkegiatan', $id_sub)
                    ->where('id_rekening', $id_rek)
                    ->whereHas('rincian', function ($q) use ($jenis) {
            $q->where('jenis', $jenis);
        })
                    ->where('id_user', Auth::user()->id)
                    ->where('id_tahun', Auth::user()->id_tahun)
                    ->orderBy('nm_anggaran')
                    ->get();
    
            return response()->json($data);
    
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public function getTujuan(Request $request)
    {
        $search = $request->q;

        $data = Perjalanan::whereNot('jenis', '1')->where('tujuan', 'like', "%$search%")
            ->select('tujuan')
            ->distinct()
            ->limit(10)
            ->get();

        return response()->json(
            $data->map(function ($item) {
                return [
                    'id' => $item->tujuan,
                    'text' => $item->tujuan
                ];
            })
        );
    }

    
}
