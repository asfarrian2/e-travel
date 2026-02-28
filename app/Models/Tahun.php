<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $table='tb_tahun';
    protected $primaryKey = 'id_tahun';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['tahun', 'status', 'dpa', 'tgl_dpa'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $last = self::latest('id_tahun')->first();

            if (!$last) {
                $number = 1;
            } else {
                $number = (int) substr($last->id_tahun, 3) + 1;
            }

            $model->id_tahun = 'th-' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }    
    
}
