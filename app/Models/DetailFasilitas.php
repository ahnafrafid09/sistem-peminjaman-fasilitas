<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFasilitas extends Model
{
    use HasFactory;
    protected $fillable = ["fasilitas_id", 'nama', 'unit', 'luas', "lama_sewa"];
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function tarif()
    {
        return $this->hasMany(Tarif::class);
    }
    public function detailFasilitas()
    {
        return $this->hasMany(DetailFasilitas::class);
    }
}
