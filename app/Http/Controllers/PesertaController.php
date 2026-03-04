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
use App\Models\Perjalanan;

class PesertaController extends Controller
{
    public function view() {

         $kelompok = Pelaksana::where('jenis', '3')->select('kelompok')
                    ->distinct()->orderBy('kelompok', 'ASC')
                    ->get();

        return view('admin.peserta.view', compact('kelompok'));
    }

    //View PPTK
    public function pptk_view($id_perjalanan){

        $id_perjalanan = Crypt::decrypt($id_perjalanan);

        $perjalanan = Perjalanan::where('id_perjalanan', $id_perjalanan)->first();

        $pelaksana  = Pelperjadin::where('id_perjalanan', $id_perjalanan)->get();

        return view('pptk.peserta.view', compact('perjalanan', 'pelaksana'));

    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $nama           = $request->nama;
            $alamat         = $request->alamat;
            $jabatan        = $request->jabatan;
            $kelompok       = $request->kelompok;
            $uang_harian    = str_replace('.', '', $request->uang_harian);
            $uang_transport = str_replace('.', '', $request->uang_transport);
            $id_perjalanan  = Crypt::decrypt($request->id_perjalanan);

            $data1 = [
                'nama'            => $nama,
                'alamat'          => $alamat,
                'jabatan'         => $jabatan,
                'kelompok'        => $kelompok,
                'kelas'           => '0',
                'jenis'           => '3',
                'status'          => '1'
            ];

            $simpanPelaksana = Pelaksana::create($data1);

            // Ambil id hasil insert
            $id_pelaksana = $simpanPelaksana->id_pelaksana;

            $data2 = [
                'id_perjalanan' => $id_perjalanan,
                'id_pelaksana'  => $id_pelaksana,
                'uang_harian'   => $uang_harian,
                'uang_transport'=> $uang_transport
            ];

            $simpanPelperjadin = Pelperjadin::create($data2);

            DB::commit();

            if ($simpanPelaksana && $simpanPelperjadin) {
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan (' . $e .')']);
        }
    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_perjalanan   = Crypt::decrypt($request->id_perjalanan);
        $id_pelaksana    = Crypt::decrypt($request->id_pelaksana);

        $peserta     = Pelaksana::where('id_pelaksana', $id_pelaksana)->first();
        $pelperjadin = Pelperjadin::where('id_perjalanan', $id_perjalanan)->where('id_pelaksana', $id_pelaksana)
                       ->first();

        return view('pptk.peserta.edit', compact('peserta', 'pelperjadin'));

    }

    public function update(Request $request){

        $id_pelaksana   = Crypt::decrypt($request->id_pelaksana);
        $id_pelperjadin = Crypt::decrypt($request->id_pelperjadin);
        $nama           = $request->nama;
        $alamat         = $request->alamat;
        $jabatan        = $request->jabatan;
        $uang_harian    = str_replace('.', '', $request->uang_harian);
        $uang_transport = str_replace('.', '', $request->uang_transport);

        $data1       = [
            'nama'       => $nama,
            'alamat'     => $alamat,
            'jabatan'    => $jabatan
        ];

        $data2       = [
            'uang_harian'    => $uang_harian,
            'uang_transport' => $uang_transport
        ];

        $uPelaksana   = Pelaksana::where('id_pelaksana', $id_pelaksana)->update($data1);
        $uPelperjadin = Pelperjadin::where('id_pelperjadin', $id_pelperjadin)->update($data2);
        if ($uPelaksana & $uPelperjadin) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_pelaksana){

        $id_pelaksana   = Crypt::decrypt($id_pelaksana);
        $peserta      = Pelaksana::where('id_pelaksana', $id_pelaksana)->first();

        $status     = $peserta->status;

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

    public function hapus($id_pelaksana, $id_perjalanan){

        $id_pelaksana   = Crypt::decrypt($id_pelaksana);
        $id_perjalanan  = Crypt::decrypt($id_perjalanan);
        $pelperjadin    = Pelperjadin::where('id_perjalanan', $id_perjalanan)->where('id_pelaksana', $id_pelaksana)
                          ->first();

        $delete1 = Pelaksana::where('id_pelaksana',$id_pelaksana)->delete();
        $delete2 = Pelperjadin::where('id_pelperjadin',$pelperjadin->id_pelperjadin)->delete();
        if ($delete1 & $delete2) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
        
    }


}

