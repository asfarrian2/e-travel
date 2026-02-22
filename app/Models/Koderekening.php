<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koderekening extends Model
{
    protected $table="tb_rekening";
    protected $fillable = ['id_rekening', 'kd_rekening', 'nm_rekening', 'status'];
}
