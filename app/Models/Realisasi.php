<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $table = 'tb_realisasi';

    protected $primaryKey = 'id_realisasi';

    public $incrementing = true; // karena auto number

    protected $keyType = 'int'; // karena bigint

    protected $fillable = [
        'id_rincanggaran',
        'id_subspj',
        'id_pelperjadin',
        'kegunaan',
        'nilai',
        'volume',
    ];

    public function rincian()
    {
        return $this->belongsTo(RincAnggaran::class, 'id_rincanggaran', 'id_rincanggaran');
    }

    public function pelperjadin()
    {
        return $this->belongsTo(Pelperjadin::class, 'id_pelperjadin', 'id_pelperjadin');
    }

    
}
