<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pesanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika nama model sudah sesuai).
     *
     * @var string
     */
    protected $table = 'pesanans';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'harga_tiket',
        'jumlah_tiket',
        'total_harga',
    ];

    /**
     * Getter untuk kolom `total_harga`.
     *
     * @return Attribute
     */
    protected function totalHarga(): Attribute
    {
        return Attribute::make(
            get: fn ($totalHarga) => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
        );
    }
}
