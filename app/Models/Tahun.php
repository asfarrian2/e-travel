<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dpa;

class Tahun extends Model
{
    protected $table='tb_tahun';
    protected $fillable = ['id_tahun', 'tahun', 'status'];
    
}
