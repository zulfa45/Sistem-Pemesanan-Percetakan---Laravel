<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service; // <--- TAMBAHKAN BARIS INI
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $services = Service::all(); 
        $orders = Order::with('service')->where('user_id', Auth::id())->latest()->get();
        
        return view('customer.pesan', compact('services', 'orders'));
    }

    public function store(Request $request)
    {
        // ... (kode store Anda tetap sama seperti sebelumnya)
        $service = Service::findOrFail($request->service_id);
        
        Order::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $service->harga * $request->jumlah,
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Pesanan berhasil dikirim!');
    }
}