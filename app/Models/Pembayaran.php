<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = ['peminjaman_id', 'metode_pembayaran_id', 'kode', 'status', 'bukti_pembayaran', 'total_harga'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }
}
