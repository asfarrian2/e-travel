<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Anggaran extends Model
{
    protected $table="tb_anggaran";
    protected $primaryKey = 'id_anggaran';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_tahun', 'id_user', 'id_subkegiatan', 'id_rekening', 'nm_anggaran', 'sub_anggaran', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $id_tahun = Auth::user()->id_tahun;
            $last = self::where('id_tahun', $id_tahun)
                ->latest('id_anggaran')
                ->first();

            if (!$last) {
                $number = 1;
            } else {
                $number = (int) substr($last->id_anggaran, -6) + 1;
            }

            $model->id_tahun = $id_tahun;
            $model->id_anggaran = 'ang' . $id_tahun . str_pad($number, 6, '0', STR_PAD_LEFT);
        });
    }

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
