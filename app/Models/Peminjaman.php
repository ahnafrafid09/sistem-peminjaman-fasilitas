<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = "peminjaman";

    protected $fillable = [
        'fasilitas_id',
        'detail_fasilitas_id',
        'tarif_id',
        'user_id',
        'kode',
        'tanggal_peminjaman',
        'tanggal_pemasangan_alat',
        'tanggal_pembongkaran_alat',
        'layanan_eksternal',
        'status',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function detailFasilitas()
    {
        return $this->belongsTo(DetailFasilitas::class);
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(pembayaran::class);
    }
}
