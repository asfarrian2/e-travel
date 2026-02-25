<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KoderekeningController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerjadinController;
use App\Http\Controllers\ProsesAjaxController;
use App\Http\Controllers\RincanggaranController;
use App\Http\Controllers\SubkegiatanController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'view'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

//--*Admin--
Route::group(['middleware' => ['auth', 'role:admin']], function () {
//--Admin-Dashboard--
Route::get('/admin/dashboard', [DashboardController::class, 'admin_view']);
//--Admin-Anggaran Dasar--
Route::get('/admin/anggarandasar', [TahunController::class, 'view']);
Route::post('/admin/anggarandasar/store', [TahunController::class, 'store'])->name('a.tahun');
Route::post('/admin/anggarandasar/edit', [TahunController::class, 'edit']);
Route::post('/admin/anggarandasar/update', [TahunController::class, 'update'])->name('u.tahun');
Route::get('/admin/anggarandasar/hapus{id_tahun}', [TahunController::class, 'hapus']);
Route::get('/admin/anggarandasar/status{id_tahun}', [TahunController::class, 'status']);
//--Admin-Pegawai--
Route::get('/admin/pelaksana/pegawai', [PegawaiController::class, 'view']);
Route::post('/admin/pelaksana/pegawai/store', [PegawaiController::class, 'store'])->name('a.pegawai');
Route::post('/admin/pelaksana/pegawai/edit', [PegawaiController::class, 'edit']);
Route::post('/admin/pelaksana/pegawai/update', [PegawaiController::class, 'update'])->name('u.pegawai');
Route::get('/admin/pelaksana/pegawai/hapus{id_tahun}', [PegawaiController::class, 'hapus']);
Route::get('/admin/pelaksana/pegawai/status{id_tahun}', [PegawaiController::class, 'status']);
//--Admin-User--
Route::get('/admin/akun', [UserController::class, 'view']);
Route::post('/admin/akun/store', [UserController::class, 'store'])->name('a.akun');
Route::post('/admin/akun/edit', [UserController::class, 'edit']);
Route::post('/admin/akun/update', [UserController::class, 'update'])->name('u.akun');
Route::get('/admin/akun/hapus{id}', [UserController::class, 'hapus']);
Route::get('/admin/akun/status{id}', [UserController::class, 'status']);
//--Admin-Sub Kegiatan--
Route::get('/admin/kegiatan/subkegiatan', [SubkegiatanController::class, 'view']);
Route::post('/admin/kegiatan/subkegiatan/store', [SubkegiatanController::class, 'store'])->name('a.subkegiatan');
Route::post('/admin/kegiatan/subkegiatan/edit', [SubkegiatanController::class, 'edit']);
Route::post('/admin/kegiatan/subkegiatan/update', [SubkegiatanController::class, 'update'])->name('u.subkegiatan');
Route::get('/admin/kegiatan/subkegiatan/hapus{id_tahun}', [SubkegiatanController::class, 'hapus']);
Route::get('/admin/kegiatan/subkegiatan/status{id_tahun}', [SubkegiatanController::class, 'status']);
//--Admin-Kode Rekening--
Route::get('/admin/kegiatan/koderekening', [KoderekeningController::class, 'view']);
Route::post('/admin/kegiatan/koderekening/store', [KoderekeningController::class, 'store'])->name('a.koderekening');
Route::post('/admin/kegiatan/koderekening/edit', [KoderekeningController::class, 'edit']);
Route::post('/admin/kegiatan/koderekening/update', [KoderekeningController::class, 'update'])->name('u.koderekening');
Route::get('/admin/kegiatan/koderekening/hapus{id_tahun}', [KoderekeningController::class, 'hapus']);
Route::get('/admin/kegiatan/koderekening/status{id_tahun}', [KoderekeningController::class, 'status']);

});
//

//--*PPTK--
Route::group(['middleware' => ['auth', 'role:pptk']], function () {
//--PPTK-Dashboard--
Route::get('/dashboard', [DashboardController::class, 'pptk_view']);
//--PPTK-Anggaran--
Route::get('/anggaran', [AnggaranController::class, 'view']);
Route::post('/anggaran/store', [AnggaranController::class, 'store'])->name('a.anggaran');
Route::post('/anggaran/edit', [AnggaranController::class, 'edit']);
Route::post('/anggaran/update', [AnggaranController::class, 'update'])->name('u.anggaran');
Route::get('/anggaran/hapus/{id_anggaran}', [AnggaranController::class, 'hapus']);
//--PPTK-Rincian Anggaran--
Route::post('/rinciananggaran/add', [RincanggaranController::class, 'add']);
Route::post('/rinciananggaran/store', [RincanggaranController::class, 'store'])->name('a.rincanggaran');
Route::post('/rinciananggaran/edit', [RincanggaranController::class, 'edit']);
Route::post('/rinciananggaran/update', [RincanggaranController::class, 'update'])->name('u.rincanggaran');
Route::get('/rinciananggaran/hapus/{id_rincanggaran}', [RincanggaranController::class, 'hapus']);
//--PPTK-Perjadin--
Route::get('/perjalanan/dinas', [PerjadinController::class, 'viewd']);
Route::post('/perjalanan/dinas/store', [PerjadinController::class, 'store'])->name('a.perjadin');
Route::post('/perjalanan/dinas/edit', [PerjadinController::class, 'edit']);
Route::post('/perjalanan/dinas/update', [PerjadinController::class, 'update'])->name('u.perjadin');
Route::get('/perjalanan/dinas/hapus/{id_anggaran}', [PerjadinController::class, 'hapus']);
Route::post('/perjalanan/dinas/addpegawai', [PerjadinController::class, 'add_pegawai']);
Route::post('/perjalanan/dinas/listpegawai', [PerjadinController::class, 'list_pegawai']);
Route::post('/perjalanan/dinas/kirim', [PerjadinController::class, 'kirim']);
Route::post('/perjalanan/dinas/submit', [PerjadinController::class, 'submit'])->name('u.submit');
Route::get('/perjalanan/dinas/batal/{id_perjalanan}', [PerjadinController::class, 'batal']);

});

//(--------AJAX---------)//
Route::get('/get-anggaran', [ProsesAjaxController::class, 'getAnggaran'])->name('get.anggaran');
Route::get('/get-subanggaran', [ProsesAjaxController::class, 'getSubAnggaran'])->name('get.subanggaran');
Route::post('/simpanperjadin-pegawai', [PerjadinController::class, 'simpanPegawai']);
Route::post('/hapusperjadin-pegawai', [PerjadinController::class, 'hapusPegawai']);
Route::post('/get-koderekening', [ProsesAjaxController::class, 'getPerjKodeRekening'])->name('get.koderekening');
Route::post('/get-anggaranperjalanan', [ProsesAjaxController::class, 'getPerjAnggaran'])->name('get.anggaranperjalanan');
