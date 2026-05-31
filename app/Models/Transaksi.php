<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'penyewa_id',
        'lapangan_id',
        'tanggal_main',
        'jam_mulai',
        'jam_selesai',
        'durasi_jam',
        'total_harga',
        'dp_dibayar',
        'status_pembayaran',
        'metode_pembayaran',
    ];

    /**
     * Relasi balik ke Penyewa (Many to One)
     */
    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }

    /**
     * Relasi balik ke Lapangan (Many to One)
     */
    public function lapangan(): BelongsTo
    {
        return $this->belongsTo(Lapangan::class, 'lapangan_id');
    }
}