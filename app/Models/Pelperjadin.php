<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelperjadin extends Model
{
    protected $table="tb_pelperjadin";
    protected $fillable = ['id_pelperjadin',
                            'id_perjalanan',
                            'id_pelaksana',
                            'penginapan',
                            'maskapaib',
                            'bandarab',
                            'no_tiketb',
                            'no_bookingb',
                            'maskapaip',
                            'bandarap',
                            'no_tiketp',
                            'no_bookingp',                      
    ];

    //Relasi ke Perjalanan
    public function perjalanan()
    {
        return $this->belongsTo(Perjalanan::class, 'id_perjalanan', 'id_perjalanan');
    }

    //Relasi ke Pelaksana
    public function pelaksana()
    {
        return $this->belongsTo(Pelaksana::class, 'id_pelaksana', 'id_pelaksana');
    }

}
