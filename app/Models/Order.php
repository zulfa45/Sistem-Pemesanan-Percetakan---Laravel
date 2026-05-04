<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_resi', 'nama_pelanggan', 'no_hp', 'alamat', 
        'service_id', 'jumlah', 'total_harga', 'snap_token', 'catatan', 
        'file_desain', 'foto_ktp', 'metode_pembayaran', 
        'bukti_pembayaran', 'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}