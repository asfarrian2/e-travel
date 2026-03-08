<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subspj extends Model
{
    protected $table = 'tb_subspj';

    protected $primaryKey = 'id_subspj';

    public $incrementing = true; // karena auto number

    protected $keyType = 'int'; // karena bigint

    protected $fillable = [
        'id_spj',
        'id_perjalanan',
    ];

    public function spj()
    {
        return $this->belongsTo(Spj::class, 'id_spj', 'id_spj');
    }

    public function perjalanan()
    {
        return $this->belongsTo(Perjalanan::class, 'id_perjalanan', 'id_perjalanan');
    }

    
}
