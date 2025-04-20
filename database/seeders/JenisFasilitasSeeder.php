<?php

namespace Database\Seeders;

use App\Models\JenisFasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Ruangan',
            'Gedung dan Bangunan',
            'Peralatan dan Mesin',
            'Lahan'
        ];

        foreach ($data as $nama) {
            JenisFasilitas::create([
                'nama' => $nama
            ]);
        }
    }
}
