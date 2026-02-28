<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koderekening extends Model
{
    protected $table="tb_rekening";
    protected $primaryKey = 'id_rekening';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_rekening', 'nm_rekening', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $last = self::latest('id_rekening')->first();

            if (!$last) {
                $number = 1;
            } else {
                $number = (int) substr($last->id_rekening, -5) + 1;
            }

            $model->id_rekening = 'rek' . str_pad($number, 5, '0', STR_PAD_LEFT);
        });
    }

    
}
