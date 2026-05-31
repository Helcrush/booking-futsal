<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = [
        'penyewa_id',
        'kode_member',
        'tanggal_join',
        'tanggal_kadaluarsa',
        'status_member',
    ];

    /**
     * Relasi balik ke Penyewa (One to One / Belongs To)
     */
    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }
}