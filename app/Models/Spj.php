<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    protected $table = 'tb_spj';

    protected $primaryKey = 'id_spj';

    public $incrementing = true; // karena auto number

    protected $keyType = 'int'; // karena bigint

    protected $fillable = [
        'id_user',
        'id_tahun',
        'id_subkegiatan',
        'id_rekening',
        'uraian',
        'tgl',
        'jenis',
        'pengguna',
        'status',
    ];

    protected $appends = ['nomor_spj'];

    public function getNomorSpjAttribute()
    {
        $no = str_pad($this->id_spj, 4, '0', STR_PAD_LEFT);
        $tahun = date('Y', strtotime($this->tgl));

        return $no.'/SPJ/'.$tahun;
    }

    // SPJ milik user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // SPJ milik tahun
    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id_tahun');
    }

    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'id_subkegiatan', 'id_subkegiatan');
    }

    public function rekening()
    {
        return $this->belongsTo(Koderekening::class, 'id_rekening', 'id_rekening');
    }

    // SPJ milik anggaran
    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'id_anggaran', 'id_anggaran');
    }

    // SPJ punya banyak SubSPJ
    public function subspj()
    {
        return $this->hasMany(Subspj::class, 'id_spj', 'id_spj');
    }
}