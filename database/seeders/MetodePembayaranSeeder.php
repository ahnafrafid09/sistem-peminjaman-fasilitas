<?php

namespace Database\Seeders;

use App\Models\MetodePembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['nama_bank' => 'Bank Mandiri', 'no_rekening' => '1230001112223'],
            ['nama_bank' => 'Bank BCA', 'no_rekening' => '9876543210'],
            ['nama_bank' => 'Bank BRI', 'no_rekening' => '0029384756'],
            ['nama_bank' => 'Bank BNI', 'no_rekening' => '3214567890'],
            ['nama_bank' => 'Bank CIMB Niaga', 'no_rekening' => '800123456789'],
            ['nama_bank' => 'Bank BTN', 'no_rekening' => '220011223344'],
        ];

        foreach ($banks as $bank) {
            MetodePembayaran::create([
                'nama_bank' => $bank['nama_bank'],
                'no_rekening' => $bank['no_rekening'],
            ]);
        }
    }
}
