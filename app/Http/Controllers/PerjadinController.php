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
use App\Models\Tahun;
use App\Models\User;

class PerjadinController extends Controller
{

    public function pptk_view(Request $request)
    {
        $user  = Auth::user();

        $tahun  = Tahun::where('id_tahun', $user->id_tahun)->first();
        $ytahun = $tahun->tahun;

        if (!$request->jenis) {
            return view('pptk.perjadin.view', [
                'hapus'  => collect(),
                'draft'  => collect(),
                'disetujui'=> collect(),
                'ytahun' => $ytahun
            ]);
        }

        $baseQuery = Perjalanan::where('jenis', $request->jenis)
            ->where('id_tahun', $user->id_tahun)
            ->where('id_user', $user->id);

        $hapus  = (clone $baseQuery)->where('status', '0')->get(); // hapus
        $draft  = (clone $baseQuery)->whereIn('status', ['1', '2'])->get(); // draft
        $disetujui  = (clone $baseQuery)->where('status', '3')->get(); // disetujui

        return view('pptk.perjadin.view', compact('hapus', 'draft', 'disetujui', 'ytahun'));
    }

    public function kpa_view(Request $request)
    {
        $user  = Auth::user();

        $tahun  = Tahun::where('id_tahun', $user->id_tahun)->first();
        $ytahun = $tahun->tahun;

        if (!$request->jenis) {
            return view('kpa.perjadin.view', [
                'hapus'  => collect(),
                'kirim'  => collect(),
                'disetujui'=> collect(),
                'ytahun' => $ytahun
            ]);
        }

        $baseQuery = Perjalanan::where('jenis', $request->jenis)
            ->where('id_tahun', $user->id_tahun);

        $hapus  = (clone $baseQuery)->where('status', '0')->get(); // hapus
        $kirim  = (clone $baseQuery)->where('status', '2')->get(); // kirim
        $disetujui  = (clone $baseQuery)->where('status', '3')->get(); // disetujui

        return view('kpa.perjadin.view', compact('hapus', 'kirim', 'disetujui', 'ytahun'));
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

        $id_perjalanan = Crypt::decrypt($request->id_perjalanan);

        $perjalanan = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();

        return view('pptk.perjadin.edit', compact('perjalanan'));
    }

    public function update(Request $request){

        $id_perjalanan= Crypt::decrypt($request->id);
        $dasar        = $request->dasar;
        $keperluan    = $request->keperluan;
        $tujuan       = $request->tujuan;
        $tgl_berangkat= $request->tgl_berangkat;
        $tgl_pulang   = $request->tgl_pulang;
        $angkutan     = $request->angkutan;

        $data       = [
            'dasar'        => $dasar,
            'keperluan'    => $keperluan,
            'tujuan'       => $tujuan,
            'tgl_berangkat'=> $tgl_berangkat,
            'tgl_pulang'   => $tgl_pulang,
            'angkutan'     => $angkutan,
        ];

        $update = Perjalanan::where('id_perjalanan', $id_perjalanan)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function kirim(Request $request){

        $id_perjalanan = Crypt::decrypt($request->id_perjalanan);

        $perjalanan = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();

        $subkegiatan = Anggaran::where('id_user', Auth::user()->id)
                ->where('id_tahun', Auth::user()->id_tahun)
                ->get()
                ->unique('subkegiatan')
                ->values();

        return view('pptk.perjadin.kirim', compact('perjalanan', 'subkegiatan'));
    }

    public function setuju(Request $request){

        $id_perjalanan = Crypt::decrypt($request->id_perjalanan);

        $data       = [
            'status'        => '3'
        ];

        $update = Perjalanan::where('id_perjalanan', $id_perjalanan)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function submit(Request $request){

        $id_perjalanan = Crypt::decrypt($request->id);
        $anggaran = $request->anggaran;

        $data       = [
            'status'        => '2',
            'id_anggaran'   => $anggaran
        ];

        $update = Perjalanan::where('id_perjalanan', $id_perjalanan)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function batal(Request $request){

        $id_perjalanan = Crypt::decrypt($request->id_perjalanan);

        $data       = [
            'status'        => '1',
            'id_anggaran'   => ''
        ];

        $update = Perjalanan::where('id_perjalanan', $id_perjalanan)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function hapus(Request $request){

        $id_perjalanan = Crypt::decrypt($request->id_perjalanan);

        $data       = [
            'status'        => '0',
            'id_anggaran'   => ''
        ];

        $update = Perjalanan::where('id_perjalanan', $id_perjalanan)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }




    // ***********************************
    // Proses Simpan Pelaksana / Pegawai 
    // ***********************************
    public function add_pegawai(Request $request){
        
        $id_perjalanan   = Crypt::decrypt($request->id_perjalanan);

        $pegawai = Pelaksana::where('status', '1')->where('jenis', '1')
        ->whereNotIn('id_pelaksana', function($query) use ($id_perjalanan) {
            $query->select('id_pelaksana')
                ->from('tb_pelperjadin')
                ->where('id_perjalanan', $id_perjalanan);
        })
        ->orderby('kelas', 'asc')->get();

        return view('pptk.perjadin.addpegawai', compact('pegawai'));
    }

    public function simpanPegawai(Request $request)
    {
        try {
            DB::beginTransaction();
    
            // Ambil & decrypt data
            $id_perjalanan = Crypt::decrypt($request->id_perjalanan);
            $pegawai_id    = $request->pegawai_id;
            $id_tahun      = Auth::user()->id_tahun;
            $tahun         = Tahun::where('id_tahun', $id_tahun)->first();
    
            // Prefix kode
            $prefix = 'pp-'.$tahun->tahun;
    
            // Ambil ID terakhir DENGAN LOCK
            $lastId = Pelperjadin::where('id_pelperjadin', 'like', $prefix . '%')
                ->orderBy('id_pelperjadin', 'desc')
                ->lockForUpdate()
                ->value('id_pelperjadin');
    
            // Tentukan nomor urut
            if ($lastId) {
                $nomorurut = (int) substr($lastId, -8) + 1;
            } else {
                $nomorurut = 1;
            }
    
            // Simpan data pegawai
            foreach ($pegawai_id as $id_pelaksana) {
    
                $kode = $prefix . str_pad($nomorurut, 8, '0', STR_PAD_LEFT);
    
                Pelperjadin::create([
                    'id_pelperjadin' => $kode,
                    'id_perjalanan'  => $id_perjalanan,
                    'id_pelaksana'   => Crypt::decrypt($id_pelaksana),
                ]);
    
                $nomorurut++;
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil disimpan'
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

    public function list_pegawai(Request $request){

        $id_perjalanan   = $request->id_perjalanan;
        $id_perjalanan   = Crypt::decrypt($id_perjalanan);

        $perjalanan      = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();

        $status        = $perjalanan->status;

        $pelperjadin     = Pelperjadin::where('id_perjalanan', $id_perjalanan)
                         ->orderBy(
                            Pelaksana::select('kelas')
                                ->whereColumn('tb_pelaksana.id_pelaksana', 'tb_pelperjadin.id_pelaksana')
                            )
                        ->get();

        $pegawai       = Pelaksana::all();

        return view('pptk.perjadin.listpegawai', compact('pegawai', 'id_perjalanan', 'pelperjadin', 'pegawai', 'status'));
        
    }

    public function hapusPegawai(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!$request->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada data yang dipilih'
                ]);
            }

            foreach ($request->id as $encryptedId) {
                $id = Crypt::decrypt($encryptedId);

                Pelperjadin::where('id_pelperjadin', $id)->delete();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function laporanSpt($id_perjalanan){

        $id_tahun = Auth::user()->id_tahun;
        $tahun    = Tahun::where('id_tahun', $id_tahun)->first();
        $kpa      = User::where('role', 'kpa')->first();

        $id_perjalanan = Crypt::decrypt($id_perjalanan);

        $perjadin    = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();

        $pelperjadin = Pelperjadin::where('id_perjalanan', $id_perjalanan)
                     ->whereHas('pelaksana')
                     ->orderBy(
                         Pelaksana::select('kelas')
                             ->whereColumn('tb_pelaksana.id_pelaksana', 'tb_pelperjadin.id_pelaksana')
                     )
                     ->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0, 0, 595.28, 935.43], 'potrait');
        
        $pdf->loadView('pptk.perjadin.output.spt', compact('perjadin', 'pelperjadin', 'kpa', 'tahun'));


        return $pdf->stream('SPT '.$perjadin->tgl_berangkat.' '.$perjadin->keperluan.' '.$perjadin->tujuan.'.pdf');
    }
    
    public function laporanSpd($id_perjalanan){

        $id_tahun = Auth::user()->id_tahun;
        $tahun    = Tahun::where('id_tahun', $id_tahun)->first();
        $kpa      = User::where('role', 'kpa')->first();

        $id_perjalanan = Crypt::decrypt($id_perjalanan);

        $perjadin    = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();

        $pelperjadin = Pelperjadin::where('id_perjalanan', $id_perjalanan)
                     ->whereHas('pelaksana')
                     ->orderBy(
                         Pelaksana::select('kelas')
                             ->whereColumn('tb_pelaksana.id_pelaksana', 'tb_pelperjadin.id_pelaksana')
                     )
                     ->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0, 0, 595.28, 935.43], 'potrait', [
            'margin-top' => '0.5in',
            'margin-right' => '0.5in',
            'margin-bottom' => '0.5in',
            'margin-left' => '0.5in',
        ]);
        
        $pdf->loadView('pptk.perjadin.output.sppd', compact('perjadin', 'pelperjadin', 'tahun', 'kpa'));


        return $pdf->stream('SPD'.$perjadin->tgl_berangkat.' '.$perjadin->keperluan.' '.$perjadin->tujuan.'.pdf');
    }



}
