<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkegiatan extends Model
{
    protected $table='tb_subkegiatan';
    protected $primaryKey = 'id_subkegiatan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_subkegiatan', 'nm_subkegiatan', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $last = self::latest('id_subkegiatan')->first();

            if (!$last) {
                $number = 1;
            } else {
                $number = (int) substr($last->id_subkegiatan, -5) + 1;
            }

            $model->id_subkegiatan = 'sub' . str_pad($number, 5, '0', STR_PAD_LEFT);
        });
    }
    
}
