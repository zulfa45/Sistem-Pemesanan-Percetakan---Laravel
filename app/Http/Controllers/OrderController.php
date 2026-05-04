<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Memperbarui status pesanan (Bisa digunakan oleh Admin & Kasir)
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status agar tidak diisi sembarangan
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai'
        ]);

        // Cari pesanan berdasarkan ID, lalu update statusnya
        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        // Kembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Status pesanan ' . $order->nomor_resi . ' berhasil diperbarui menjadi: ' . strtoupper($request->status));
    }
}