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
    
    //Relasi ke User
    public function pptk()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    
    //Relasi ke Anggaran
    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'id_anggaran', 'id_anggaran');
    }

    //Relasi ke Rincian Pelaksana
    public function pelperjadin()
    {
        return $this->hasMany(Pelperjadin::class, 'id_perjalanan', 'id_perjalanan');
    }

}
