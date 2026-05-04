<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class PublicOrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    // Menampilkan Form Tahap 1
    public function create(Request $request)
    {
        $selectedServiceId = $request->query('service_id');
        $services = Service::all();
        return view('publik.pesan', compact('services', 'selectedServiceId'));
    }

    // Menyimpan Data Tahap 1 & Arahkan ke Pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'jumlah' => 'required|integer|min:1',
            'file_desain' => 'nullable|file|mimes:pdf,jpg,png,zip|max:10240',
            'foto_ktp' => 'required|image|mimes:jpg,png|max:5120',
        ]);

        $service = Service::findOrFail($request->service_id);
        
        $pathDesain = $request->hasFile('file_desain') 
            ? $request->file('file_desain')->store('uploads/desain', 'public')
            : null;
            
        $pathKtp = $request->file('foto_ktp')->store('uploads/ktp', 'public');

        $resi = 'SPK-' . strtoupper(Str::random(7));

        $order = Order::create([
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
            'status' => 'menunggu_pembayaran', // Status awal
        ]);

        // --- Integrasi Midtrans ---
        $params = [
            'transaction_details' => [
                'order_id' => $order->nomor_resi,
                'gross_amount' => $order->total_harga,
            ],
            'customer_details' => [
                'first_name' => $order->nama_pelanggan,
                'phone' => $order->no_hp,
            ],
            'item_details' => [
                [
                    'id' => $service->id,
                    'price' => $service->harga,
                    'quantity' => $order->jumlah,
                    'name' => $service->nama_jasa,
                ]
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        $order->update(['snap_token' => $snapToken]);

        // Lanjut ke Tahap 2
        return redirect()->route('pesan.bayar', $resi);
    }

    // Menampilkan Halaman Pembayaran (Tahap 2)
    public function bayar($resi)
    {
        $order = Order::where('nomor_resi', $resi)->where('status', 'menunggu_pembayaran')->firstOrFail();
        return view('publik.bayar', compact('order'));
    }

    // Callback Midtrans
    public function callback(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();
            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $order_id = $notification->order_id;
            $fraud = $notification->fraud_status;

            $order = Order::where('nomor_resi', $order_id)->first();

            if (!$order) {
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $order->update(['status' => 'menunggu_pembayaran']);
                    } else {
                        $order->update(['status' => 'diproses', 'metode_pembayaran' => $type]);
                    }
                }
            } elseif ($transaction == 'settlement') {
                $order->update(['status' => 'diproses', 'metode_pembayaran' => $type]);
            } elseif ($transaction == 'pending') {
                $order->update(['status' => 'menunggu_pembayaran', 'metode_pembayaran' => $type]);
            } elseif ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $order->update(['status' => 'batal']);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Memproses Bukti Pembayaran (Lama - Masih dipertahankan sebagai fallback)
    public function prosesBayar(Request $request, $resi)
    {
        $order = Order::where('nomor_resi', $resi)->firstOrFail();

        $request->validate([
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $pathBukti = $request->file('bukti_pembayaran')->store('uploads/bukti', 'public');

        $order->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $pathBukti,
            'status' => 'pending', // Siap diproses kasir
        ]);

        // Lanjut ke Struk Akhir
        return redirect()->route('struk.show', $resi)->with('success', 'Pembayaran berhasil dikirim!');
    }

    // Menampilkan Struk
    public function struk($resi)
    {
        $order = Order::with('service')->where('nomor_resi', $resi)->firstOrFail();
        return view('publik.struk', compact('order'));
    }
}