<x-app-layout>
    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header & Filter Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white">Dashboard Analytics</h2>
                    <p class="text-slate-500 dark:text-slate-400">Ringkasan performa bisnis Spektrum Multi Grafika</p>
                </div>
                
                <div class="flex flex-wrap items-center gap-3">
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center bg-white dark:bg-slate-900 p-1 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
                        <select name="filter" onchange="this.form.submit()" class="bg-transparent border-none text-sm font-bold text-slate-700 dark:text-slate-300 focus:ring-0 cursor-pointer">
                            <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                            <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="weekly" {{ $filter == 'weekly' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Tahun Ini</option>
                        </select>
                    </form>

                    <a href="{{ route('admin.dashboard.pdf', ['filter' => $filter]) }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-600/20 transition-all transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Export PDF
                    </a>
                </div>
            </div>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="group bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402-2.599-1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-lg">Revenue</span>
                    </div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">Rp {{ number_format($totalPendapatan) }}</p>
                </div>

                <div class="group bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-blue-500 bg-blue-50 dark:bg-blue-900/20 px-2 py-1 rounded-lg">Orders</span>
                    </div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pesanan</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $totalPesanan }}</p>
                </div>

                <div class="group bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-amber-500 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg">Pending</span>
                    </div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Menunggu Konfirmasi</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $pesananPending }}</p>
                </div>

                <div class="group bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-purple-500 bg-purple-50 dark:bg-purple-900/20 px-2 py-1 rounded-lg">Active</span>
                    </div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sedang Diproses</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $pesananProses }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                <!-- Sales Chart -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Grafik Penjualan (6 Bulan Terakhir)</h3>
                    <div class="h-[300px]">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Quick Actions / Info -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 rounded-3xl shadow-xl text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-4">Informasi Sistem</h3>
                        <p class="text-blue-100 text-sm leading-relaxed mb-6">
                            Pastikan Anda selalu memeriksa bukti pembayaran sebelum mengubah status pesanan menjadi "Diproses".
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 bg-white/10 p-4 rounded-2xl backdrop-blur-sm border border-white/10">
                                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold opacity-80 uppercase">Update Terakhir</p>
                                    <p class="text-sm font-bold">{{ now()->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm rounded-3xl border border-slate-100 dark:border-slate-800 transition-colors">
                <div class="p-8 text-slate-900 dark:text-white font-black text-xl border-b border-slate-50 dark:border-slate-800 flex justify-between items-center">
                    Daftar Pesanan Masuk
                    <span class="text-sm font-bold text-slate-400">{{ count($orders) }} Pesanan ditemukan</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            <tr>
                                <th class="px-8 py-5 font-bold">Resi</th>
                                <th class="px-8 py-5 font-bold">Pelanggan</th>
                                <th class="px-8 py-5 font-bold">Layanan</th>
                                <th class="px-8 py-5 font-bold">Total</th>
                                <th class="px-8 py-5 font-bold">Status</th>
                                <th class="px-8 py-5 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($orders as $order)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-8 py-6 font-mono font-bold text-blue-600 dark:text-blue-400">#{{ $order->nomor_resi }}</td>
                                <td class="px-8 py-6">
                                    <div class="font-black text-slate-900 dark:text-white">{{ $order->nama_pelanggan }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">{{ $order->no_hp }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-slate-600 dark:text-slate-300 font-medium">{{ $order->service->nama_jasa }}</span>
                                </td>
                                <td class="px-8 py-6 font-black text-slate-900 dark:text-white">Rp {{ number_format($order->total_harga) }}</td>
                                <td class="px-8 py-6">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                                        {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : '' }}
                                        {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                        {{ $order->status == 'selesai' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : '' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <form action="{{ route('order.status', $order->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 focus:ring-blue-500">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>
                                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-slate-200 dark:text-slate-800 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="text-slate-400 font-bold italic">Tidak ada pesanan untuk filter ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = @json($chartData['labels']);
        const data = @json($chartData['datasets']);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (IDR)',
                    data: data,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            },
                            font: {
                                size: 10,
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>