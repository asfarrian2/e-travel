<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perjalanan extends Model
{
    protected $table = 'tb_perjalanan';
    protected $fillable = ['id_perjalanan', 
                            'id_user',
                            'id_tahun', 
                            'dasar', 
                            'keperluan', 
                            'tujuan', 
                            'tgl_berangkat', 
                            'tgl_pulang', 
                            'angkutan',
                            'jenis',
                            'pengguna',
                            'status',
                            ];
    
    //Relasi ke Subkegiatan
    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'id_anggaran', 'id_anggaran');
    }
}
