<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar Laravel mengizinkan input data
    protected $fillable = [
        'nama_jasa',
        'deskripsi',
        'harga',
        'satuan',
        'gambar',
    ];

    // (Opsional) Relasi ke Order yang sudah kita bahas sebelumnya
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}