<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table="tb_anggaran";
    protected $fillable = ['id_anggaran', 'id_tahun', 'id_user', 'id_subkegiatan', 'id_rekening', 'nm_anggaran', 'sub_anggaran', 'status'];

    //Relasi ke Subkegiatan
    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'id_subkegiatan', 'id_subkegiatan');
    }

    //Relasi ke Rekening
    public function rekening()
    {
        return $this->belongsTo(Koderekening::class, 'id_rekening', 'id_rekening');
    }

    //Relasi ke Rincian Anggaran
    public function rincian()
    {
        return $this->hasMany(RincAnggaran::class, 'id_anggaran', 'id_anggaran');
    }

    //Relasi ke Rincian Perjalanan
    public function perjalanan()
    {
        return $this->hasMany(Perjalanan::class, 'id_anggaran', 'id_anggaran');
    }

}
