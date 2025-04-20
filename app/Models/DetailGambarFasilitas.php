<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGambarFasilitas extends Model
{
    use HasFactory;

    protected $fillable = ["fasilitas_id", 'url_gambar'];
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }
}
