<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkegiatan extends Model
{
    protected $table='tb_subkegiatan';
    protected $fillable = ['id_subkegiatan', 'kd_subkegiatan', 'nm_subkegiatan', 'status'];
}
