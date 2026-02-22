<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaksana extends Model
{
    protected $table='tb_pelaksana';
    protected $fillable = ['id_pelaksana', 'nama', 'nip', 'pangkgol', 'jabatan', 'alamat', 'kelompok', 'status', 'kelas', 'jenis'];
}
