<?php

namespace App\Imports;

use App\Models\Pelaksana;
use App\Models\Pelperjadin;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class PelaksanaImport implements ToCollection
{
    protected $id_perjalanan;
    protected $kelompok;

    public function __construct($id_perjalanan, $kelompok)
    {
        $this->id_perjalanan = $id_perjalanan;
        $this->kelompok      = $kelompok;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        foreach ($rows->skip(1) as $row) {

            // Simpan ke tb_pelaksana
            $pelaksana = Pelaksana::create([
                'nama'     => $row[0],
                'alamat'   => $row[1],
                'jabatan'  => $row[2],
                'kelompok' => $this->kelompok,
                'jenis'    => '1',
                'kelas'    => '0',
                'status'   => '1',
            ]);

            // Simpan ke tb_pelperjadin
            Pelperjadin::create([
                'id_perjalanan' => $this->id_perjalanan,
                'id_pelaksana'  => $pelaksana->id_pelaksana,
                'uang_harian'   => $row[3],
                'uang_transport'=> $row[4],
            ]);
        }

        DB::commit();
    }
}