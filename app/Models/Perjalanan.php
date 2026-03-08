<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Perjalanan extends Model
{
    protected $table = 'tb_perjalanan';
    protected $primaryKey = 'id_perjalanan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [ 'id_user',
                            'id_tahun', 
                            'tgl',
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $id_tahun = Auth::user()->id_tahun;
            $tahun    = Tahun::where('id_tahun', $id_tahun)->first();

            $last = self::latest('id_perjalanan')
                    ->where('id_tahun', $id_tahun)
                    ->first();

            if (!$last) {
                $number = 1;
            } else {
                $number = (int) substr($last->id_perjalanan, -9) + 1;
            }

            $model->id_perjalanan = 'pt' . $tahun->tahun . str_pad($number, 9, '0', STR_PAD_LEFT);
        });
    }

    public function getNomorPerjalananAttribute()
    {
        // ambil 9 digit urutan dari id_perjalanan
        $urut = substr($this->id_perjalanan, -9);

        // jadikan 4 digit
        $nomor = str_pad((int)$urut, 4, '0', STR_PAD_LEFT);

        // ambil tahun dari tanggal
        $tahun = \Carbon\Carbon::parse($this->tgl)->format('Y');

        return "NPJ/".$nomor."/".$tahun;
    }
    
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

    //Relasi ke Rincian Pelaksana
    public function subspj()
    {
        return $this->hasMany(Subspj::class, 'id_perjalanan', 'id_perjalanan');
    }

}
