<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    public function pembayaran()
    {
        return $this->hasOne(pembayaran::class);
    }
}
