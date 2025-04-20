<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisFasilitas extends Model
{
    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class);
    }
}
