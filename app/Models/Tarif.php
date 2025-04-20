<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $fillable = ["kelompok_tarif", "harga", "fasilitas_id", "detail_fasilitas_id"];
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function detailFasilitas()
    {
        return $this->belongsTo(DetailFasilitas::class);
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}

