<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';

    protected $fillable = [
        'nama_lapangan',
        'jenis_rumput',
        'harga_per_jam',
        'deskripsi',
    ];

    /**
     * Relasi ke Jadwal (One to Many)
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'lapangan_id');
    }

    /**
     * Relasi ke Transaksi (One to Many)
     */
    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'lapangan_id');
    }
}