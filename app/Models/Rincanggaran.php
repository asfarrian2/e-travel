<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RincAnggaran extends Model
{
    protected $table="tb_rincanggaran";
    protected $fillable = ['id_rincanggaran', 'id_anggaran', 'jenis', 'kegunaan', 'uraian', 'spesifikasi', 'harga', 'volume', 'satuan'];

     //Relasi ke Anggaran
    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'id_anggaran', 'id_anggaran');
    }
    
    
}
