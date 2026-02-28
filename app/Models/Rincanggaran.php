<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RincAnggaran extends Model
{
    protected $table="tb_rincanggaran";
    protected $primaryKey = 'id_rincanggaran';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_anggaran', 'jenis', 'kegunaan', 'uraian', 'spesifikasi', 'harga', 'volume', 'satuan'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $id_tahun = Auth::user()->id_tahun;
            $tahun    = Tahun::where('id_tahun', $id_tahun)->first();

            $last = self::latest('id_rincanggaran')
                    ->whereYear('created_at', $tahun->tahun)
                    ->first();

            if (!$last) {
                $number = 1;
            } else {
                $number = (int) substr($last->id_rincanggaran, -8) + 1;
            }

            $model->id_rincanggaran = 'rng' . $tahun->tahun . str_pad($number, 8, '0', STR_PAD_LEFT);
        });
    }

     //Relasi ke Anggaran
    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'id_anggaran', 'id_anggaran');
    }
    
    
}
