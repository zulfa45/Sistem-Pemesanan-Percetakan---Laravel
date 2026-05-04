<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date');
        $query = Order::with('service');

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $orders = $query->latest()->get();
        return view('kasir.dashboard', compact('orders', 'date'));
    }

    public function create()
    {
        $services = Service::all();
        return view('kasir.order.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'jumlah' => 'required|integer|min:1',
            'file_desain' => 'nullable|file|mimes:pdf,jpg,png,zip|max:10240',
            'foto_ktp' => 'nullable|image|mimes:jpg,png|max:5120',
            'metode_pembayaran' => 'required|in:Transfer Bank,Cash',
        ]);

        $service = Service::findOrFail($request->service_id);
        
        $pathDesain = $request->hasFile('file_desain') 
            ? $request->file('file_desain')->store('uploads/desain', 'public')
            : null;
        
        // Untuk Walk-in, KTP bisa opsional (Gunakan placeholder jika kosong)
        $pathKtp = $request->hasFile('foto_ktp') 
            ? $request->file('foto_ktp')->store('uploads/ktp', 'public')
            : 'uploads/ktp/placeholder.png'; // Pastikan ada atau sesuaikan logika

        $resi = 'SPK-WALK-' . strtoupper(Str::random(5));

        Order::create([
            'nomor_resi' => $resi,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'service_id' => $request->service_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $service->harga * $request->jumlah,
            'catatan' => $request->catatan,
            'file_desain' => $pathDesain,
            'foto_ktp' => $pathKtp,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $request->metode_pembayaran === 'Cash' ? 'Lunas - Cash' : null,
            'status' => $request->metode_pembayaran === 'Cash' ? 'diproses' : 'pending',
        ]);

        return redirect()->route('kasir.dashboard')->with('success', 'Pesanan walk-in berhasil dibuat!');
    }
}