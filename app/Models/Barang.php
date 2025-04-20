<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['fasilitas_id', 'nama_barang', 'kondisi', 'tanggal', 'keterangan'];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }
}
