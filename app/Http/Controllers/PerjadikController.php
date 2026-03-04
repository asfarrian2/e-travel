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
use App\Imports\PelaksanaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Models\Anggaran;
use App\Models\Pelaksana;
use App\Models\Pelperjadin;
use App\Models\Perjalanan;
use App\Models\Tahun;
use App\Models\User;

class PerjadikController extends Controller
{
    public function pptk_view(Request $request)
    {
        $user  = Auth::user();

        $tahun  = Tahun::where('id_tahun', $user->id_tahun)->first();
        $ytahun = $tahun->tahun;

        $baseQuery = Perjalanan::where('pengguna', '3')
            ->where('id_tahun', $user->id_tahun)
            ->where('id_user', $user->id);

        $hapus  = (clone $baseQuery)->where('status', '0')->latest('created_at')->get(); // hapus
        $draft  = (clone $baseQuery)->whereIn('status', ['1', '2'])->latest('created_at')->get(); // draft
        $disetujui  = (clone $baseQuery)->where('status', '3')->latest('created_at')->get(); // disetujui

        return view('pptk.perjadik.view', compact('hapus', 'draft', 'disetujui', 'ytahun'));
    }

    public function kpa_view(Request $request)
    {
        $user  = Auth::user();

        $tahun  = Tahun::where('id_tahun', $user->id_tahun)->first();
        $ytahun = $tahun->tahun;

        $baseQuery = Perjalanan::where('pengguna', '3')
            ->where('id_tahun', $user->id_tahun);

        $hapus  = (clone $baseQuery)->where('status', '0')->latest('created_at')->get(); // hapus
        $kirim  = (clone $baseQuery)->where('status', '2')->latest('created_at')->get(); // kirim
        $disetujui  = (clone $baseQuery)->where('status', '3')->latest('created_at')->get(); // disetujui

        return view('kpa.perjadik.view', compact('hapus', 'kirim', 'disetujui', 'ytahun'));
    }

    public function store(Request $request){

        $id_user  = Auth::user()->id;
        $id_tahun = Auth::user()->id_tahun;
        
        $dasar          = $request->dasar;
        $tgl            = $request->tgl;
        $keperluan      = $request->keperluan;
        $tujuan         = $request->tujuan;
        $tgl_berangkat  = $request->tgl_berangkat;
        $tgl_pulang     = $request->tgl_pulang;
        $angkutan       = $request->angkutan;
        $jenis          = $request->jenis;

        $data = [
            'id_user'      => $id_user,
            'id_tahun'     => $id_tahun,
            'tgl'          => $tgl,
            'dasar'        => $dasar,
            'keperluan'    => $keperluan,
            'tujuan'       => $tujuan,
            'tgl_berangkat'=> $tgl_berangkat,
            'tgl_pulang'   => $tgl_pulang,
            'angkutan'     => $angkutan,
            'jenis'        => $jenis,
            'pengguna'     => '3',
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

        return view('pptk.perjadik.edit', compact('perjalanan'));
    }

    public function update(Request $request){

        $id_perjalanan= Crypt::decrypt($request->id);
        $dasar        = $request->dasar;
        $tgl          = $request->tgl;
        $keperluan    = $request->keperluan;
        $tujuan       = $request->tujuan;
        $tgl_berangkat= $request->tgl_berangkat;
        $tgl_pulang   = $request->tgl_pulang;
        $angkutan     = $request->angkutan;

        $data       = [
            'dasar'        => $dasar,
            'tgl'          => $tgl,
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

        return view('pptk.perjadik.kirim', compact('perjalanan', 'subkegiatan'));
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
    public function add_pelaksana(Request $request){
        
        $id_perjalanan   = Crypt::decrypt($request->id_perjalanan);

        $perjalanan = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();

        return view('pptk.perjadik.addpelaksana', compact('perjalanan'));
    }

  public function importPelaksana(Request $request)
    {
        // ============================
        // VALIDASI AWAL FORM
        // ============================
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
            'id'   => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('warning', $validator->errors()->first());
        }

        DB::beginTransaction();

        try {

            // ============================
            // AMBIL DATA
            // ============================
            $id_perjalanan = Crypt::decrypt($request->id);
            $kelompok      = $request->kelompok;

            $file = $request->file('file');
            $rows = Excel::toArray([], $file)[0]; // sheet pertama

            foreach ($rows as $index => $row) {

                // Skip header (baris pertama)
                if ($index == 0) {
                    continue;
                }

                $nama           = trim($row[0] ?? '');
                $alamat         = trim($row[1] ?? '');
                $jabatan        = trim($row[2] ?? '');
                $uang_harian    = $this->cleanNumber($row[3] ?? 0);
                $uang_transport = $this->cleanNumber($row[4] ?? 0);

                // ============================
                // VALIDASI PER BARIS
                // ============================

                if (empty($nama)) {
                    throw new \Exception("Baris ".($index+1)." : Nama tidak boleh kosong");
                }

                if (empty($alamat)) {
                    throw new \Exception("Baris ".($index+1)." : Alamat tidak boleh kosong");
                }

                if (empty($jabatan)) {
                    throw new \Exception("Baris ".($index+1)." : Jabatan tidak boleh kosong");
                }

                if (!is_numeric($uang_harian)) {
                    throw new \Exception("Baris ".($index+1)." : Uang harian harus angka");
                }

                if (!is_numeric($uang_transport)) {
                    throw new \Exception("Baris ".($index+1)." : Uang transport harus angka");
                }

                if ($uang_harian < 0 || $uang_transport < 0) {
                    throw new \Exception("Baris ".($index+1)." : Nominal tidak boleh minus");
                }

                // ============================
                // SIMPAN tb_pelaksana
                // ============================

                $pelaksana = Pelaksana::create([
                    'nama'      => $nama,
                    'alamat'    => $alamat,
                    'kelompok'  => $kelompok,
                    'jabatan'   => $jabatan,
                    'jenis'     => 1,
                    'kelas'     => 0,
                    'status'    => 1
                ]);

                // ============================
                // SIMPAN tb_pelperjadin
                // ============================

                Pelperjadin::create([
                    'id_perjalanan' => $id_perjalanan,
                    'id_pelaksana'  => $pelaksana->id_pelaksana,
                    'uang_harian'   => $uang_harian,
                    'uang_transport'=> $uang_transport
                ]);
            }

            DB::commit();

            return redirect()->back()
                ->with('success', 'Import data berhasil disimpan');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()
                ->with('warning', $e->getMessage());
        }
    }

    // ==================================
    // FUNGSI MEMBERSIHKAN FORMAT ANGKA
    // ==================================
    private function cleanNumber($value)
    {
        $value = trim($value);
        $value = str_replace('.', '', $value); // hapus ribuan
        $value = str_replace(',', '.', $value); // ubah koma jadi titik
        return $value;
    }


    public function list_pelaksana(Request $request){

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

        return view('kpa.perjadik.listpelaksana', compact('pegawai', 'id_perjalanan', 'pelperjadin', 'pegawai', 'status'));
        
    }

        
}

