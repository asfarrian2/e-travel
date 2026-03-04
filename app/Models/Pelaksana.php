<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaksana extends Model
{
    protected $table='tb_pelaksana';
    protected $primaryKey = 'id_pelaksana';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nama', 'nip', 'pangkgol', 'jabatan', 'alamat', 'kelompok', 'status', 'kelas', 'jenis'];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $tahun = date('Y');

            $last = self::whereYear('created_at', $tahun)
                ->latest('id_pelaksana')
                ->first();

            if (!$last) {
                $nomor = 1;
            } else {
                // ambil 7 digit terakhir
                $nomor = (int) substr($last->id_pelaksana, -7) + 1;
            }

            $model->id_pelaksana = $tahun . '-pl-' . str_pad($nomor, 7, '0', STR_PAD_LEFT);
        });
    }
}
