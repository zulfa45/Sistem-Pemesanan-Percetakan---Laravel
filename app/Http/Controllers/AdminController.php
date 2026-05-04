<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $query = Order::query();

        // Filter berdasarkan waktu
        if ($filter == 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter == 'weekly') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'monthly') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter == 'yearly') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        // Statistik Utama (berdasarkan filter)
        $totalPendapatan = (clone $query)->where('status', 'selesai')->sum('total_harga');
        $totalPesanan = (clone $query)->count();
        $pesananPending = (clone $query)->where('status', 'pending')->count();
        $pesananProses = (clone $query)->where('status', 'diproses')->count();
        
        // Data untuk Grafik (6 bulan terakhir)
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenue = Order::where('status', 'selesai')
                ->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('total_harga');
            
            $chartData['labels'][] = $month->format('M Y');
            $chartData['datasets'][] = $revenue;
        }

        // Daftar pesanan terbaru
        $orders = $query->with('service')->latest()->get();

        return view('admin.dashboard', compact(
            'totalPendapatan', 
            'totalPesanan', 
            'pesananPending', 
            'pesananProses', 
            'orders',
            'filter',
            'chartData'
        ));
    }

    public function downloadPDF(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $query = Order::query();

        if ($filter == 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter == 'weekly') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'monthly') {
            $query->whereMonth('created_at', Carbon::now()->month);
        } elseif ($filter == 'yearly') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        $orders = $query->with('service')->latest()->get();
        $totalPendapatan = $orders->where('status', 'selesai')->sum('total_harga');

        $pdf = Pdf::loadView('admin.reports.orders-pdf', [
            'orders' => $orders,
            'filter' => $filter,
            'totalPendapatan' => $totalPendapatan,
            'date' => Carbon::now()->format('d F Y')
        ]);

        return $pdf->download('Laporan-Penjualan-'.$filter.'-'.date('Ymd').'.pdf');
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return back()->with('success', 'Data pesanan berhasil dihapus.');
    }
}