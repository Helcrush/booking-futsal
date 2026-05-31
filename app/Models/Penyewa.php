<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewa';

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'alamat',
    ];

    /**
     * Relasi ke Member (One to One)
     */
    public function member(): HasOne
    {
        return $this->hasOne(Member::class, 'penyewa_id');
    }

    /**
     * Relasi ke Transaksi (One to Many)
     */
    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'penyewa_id');
    }
}