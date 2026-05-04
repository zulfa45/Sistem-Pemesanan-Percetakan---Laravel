<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 dark:text-white leading-tight transition-colors">Operasional Kasir</h2>
    </x-slot>

    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Card -->
            <div class="mb-10 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-blue-500/20 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h3 class="text-3xl font-black mb-2">Selamat Bertugas, {{ Auth::user()->name }}!</h3>
                        <p class="text-blue-100 font-medium">Kelola antrean cetakan dan layani pelanggan walk-in dengan efisien.</p>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-4">
                        <!-- Date Filter -->
                        <form action="{{ route('kasir.dashboard') }}" method="GET" class="flex items-center bg-white/10 backdrop-blur-md p-1.5 rounded-2xl border border-white/20">
                            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" class="bg-transparent border-none text-sm font-bold text-white focus:ring-0 cursor-pointer [color-scheme:dark]">
                            @if($date)
                                <a href="{{ route('kasir.dashboard') }}" class="pr-2 text-white/60 hover:text-white transition-colors" title="Reset Filter">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </a>
                            @endif
                        </form>

                        <a href="{{ route('kasir.order.create') }}" class="bg-white text-blue-700 hover:bg-blue-50 px-8 py-4 rounded-2xl font-black shadow-lg transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            Buat Pesanan Baru
                        </a>
                    </div>
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Stats Bar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-4 transition-colors">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total Antrean</p>
                        <p class="text-2xl font-black text-slate-900 dark:text-white">{{ $orders->count() }}</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-4 transition-colors">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Pending</p>
                        <p class="text-2xl font-black text-slate-900 dark:text-white">{{ $orders->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-4 transition-colors">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Selesai Hari Ini</p>
                        <p class="text-2xl font-black text-slate-900 dark:text-white">{{ $orders->where('status', 'selesai')->where('updated_at', '>=', now()->startOfDay())->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Orders Table Section -->
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm rounded-3xl border border-slate-100 dark:border-slate-800 transition-colors">
                <div class="p-8 text-slate-900 dark:text-white font-black text-xl border-b border-slate-50 dark:border-slate-800 flex justify-between items-center">
                    <span>Antrean Pesanan Aktif</span>
                    @if(session('success'))
                        <span class="text-sm font-bold text-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 px-4 py-2 rounded-xl animate-bounce">
                            {{ session('success') }}
                        </span>
                    @endif
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            <tr>
                                <th class="px-8 py-5 font-bold">Resi</th>
                                <th class="px-8 py-5 font-bold">Pelanggan</th>
                                <th class="px-8 py-5 font-bold">Detail Pesanan</th>
                                <th class="px-8 py-5 font-bold">Status</th>
                                <th class="px-8 py-5 font-bold text-center">Tindakan</th>
                            </tr>
                        </thead>
                        
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($orders as $order)
                            <tr x-data="{ showModal: false }" class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-8 py-6">
                                    <span class="font-mono font-black text-blue-600 dark:text-blue-400">#{{ $order->nomor_resi }}</span>
                                    @if(str_contains($order->nomor_resi, 'WALK'))
                                        <span class="block text-[10px] text-emerald-500 font-black uppercase mt-1">Walk-in</span>
                                    @else
                                        <span class="block text-[10px] text-blue-400 font-black uppercase mt-1">Online</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <div class="font-black text-slate-900 dark:text-white">{{ $order->nama_pelanggan }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">{{ $order->no_hp }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="font-bold text-slate-700 dark:text-slate-300">{{ $order->service->nama_jasa }}</div>
                                    <div class="text-xs text-slate-400">{{ $order->jumlah }} {{ $order->service->satuan }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm
                                        {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : '' }}
                                        {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                        {{ $order->status == 'selesai' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : '' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                
                                <td class="px-8 py-6">
                                    <div class="flex flex-col md:flex-row items-center justify-center gap-3">
                                        <button type="button" @click="showModal = true" class="w-full md:w-auto bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-black py-2.5 px-4 rounded-xl transition-all">
                                            Detail
                                        </button>

                                        <form action="{{ route('order.status', $order->id) }}" method="POST" class="w-full md:w-auto">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="w-full text-xs font-black rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 focus:ring-blue-500 shadow-sm transition-all">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Proses</option>
                                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>
                                    </div>

                                    <!-- Modal Detail (Portal to body for better Z-index) -->
                                    <template x-teleport="body">
                                        <div x-show="showModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/80 backdrop-blur-md p-4 transition-all" x-transition>
                                            <div @click.away="showModal = false" class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden border border-white/10">
                                                
                                                <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                                                    <div>
                                                        <h3 class="text-2xl font-black text-slate-900 dark:text-white">Detail Pesanan</h3>
                                                        <p class="text-blue-600 dark:text-blue-400 font-mono font-bold mt-1">#{{ $order->nomor_resi }}</p>
                                                    </div>
                                                    <button type="button" @click="showModal = false" class="p-3 bg-white dark:bg-slate-800 rounded-2xl text-slate-400 hover:text-rose-500 shadow-sm transition-all">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </div>

                                                <div class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                                        
                                                        <div class="space-y-6">
                                                            <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-3xl border border-slate-100 dark:border-slate-800">
                                                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Informasi Pemesan</p>
                                                                <p class="font-black text-slate-900 dark:text-white text-xl">{{ $order->nama_pelanggan }}</p>
                                                                <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400 font-bold mt-2">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                                    {{ $order->no_hp }}
                                                                </div>
                                                                <p class="text-slate-500 dark:text-slate-400 mt-4 text-sm leading-relaxed">📍 {{ $order->alamat }}</p>
                                                            </div>

                                                            <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-3xl border border-blue-100 dark:border-blue-800">
                                                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em] mb-4">Detail Biaya & Pembayaran</p>
                                                                <div class="flex justify-between items-start mb-4">
                                                                    <div>
                                                                        <p class="font-black text-slate-900 dark:text-white text-lg">{{ $order->service->nama_jasa }}</p>
                                                                        <p class="text-slate-500 dark:text-slate-400 text-sm">Qty: {{ $order->jumlah }} {{ $order->service->satuan }}</p>
                                                                    </div>
                                                                    <span class="text-xs font-black px-3 py-1 bg-white dark:bg-slate-800 rounded-lg shadow-sm text-slate-600 dark:text-slate-300">
                                                                        {{ $order->metode_pembayaran }}
                                                                    </span>
                                                                </div>
                                                                <div class="pt-4 border-t border-blue-200 dark:border-blue-800 flex justify-between items-center">
                                                                    <span class="text-slate-500 dark:text-slate-400 font-bold">Total Tagihan</span>
                                                                    <span class="text-2xl font-black text-blue-700 dark:text-blue-400">Rp {{ number_format($order->total_harga) }}</span>
                                                                </div>
                                                            </div>

                                                            @if($order->catatan)
                                                            <div class="bg-amber-50 dark:bg-amber-900/20 p-6 rounded-3xl border border-amber-100 dark:border-amber-800">
                                                                <p class="text-[10px] font-black text-amber-600 dark:text-amber-400 uppercase tracking-[0.2em] mb-2">Instruksi Khusus</p>
                                                                <p class="text-slate-700 dark:text-slate-300 text-sm italic font-medium leading-relaxed">"{{ $order->catatan }}"</p>
                                                            </div>
                                                            @endif
                                                            
                                                            @if($order->file_desain)
                                                            <a href="{{ asset('storage/' . $order->file_desain) }}" target="_blank" download class="group flex items-center justify-center gap-3 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-5 rounded-3xl shadow-xl shadow-emerald-600/20 transition-all transform hover:-translate-y-1 active:scale-95">
                                                                <svg class="w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                                Download Desain Pelanggan
                                                            </a>
                                                            @else
                                                            <div class="flex items-center justify-center gap-3 w-full bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 font-bold py-5 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-700">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                                Tidak Ada File Desain
                                                            </div>
                                                            @endif
                                                        </div>

                                                        <div class="space-y-8">
                                                            <div>
                                                                <p class="text-sm font-black text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2">
                                                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                                                    Bukti Pembayaran / Status
                                                                </p>
                                                                <div class="aspect-[4/3] rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-800 border-4 border-slate-50 dark:border-slate-800 shadow-inner group">
                                                                    @if($order->bukti_pembayaran && !str_contains($order->bukti_pembayaran, 'Lunas'))
                                                                        <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Transfer" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                                                    @else
                                                                        <div class="w-full h-full flex flex-col items-center justify-center text-emerald-500 gap-3">
                                                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                            <p class="font-black uppercase tracking-widest">{{ $order->bukti_pembayaran ?? 'CASH PAYMENT' }}</p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <p class="text-sm font-black text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2">
                                                                    <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                                                                    Verifikasi Identitas (KTP)
                                                                </p>
                                                                <div class="aspect-[4/3] rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-800 border-4 border-slate-50 dark:border-slate-800 shadow-inner group">
                                                                    @if($order->foto_ktp && !str_contains($order->foto_ktp, 'placeholder'))
                                                                        <img src="{{ asset('storage/' . $order->foto_ktp) }}" alt="Foto KTP" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                                                    @else
                                                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 dark:text-slate-600 gap-3">
                                                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                                            <p class="font-black uppercase tracking-widest">No ID Provided</p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-slate-200 dark:text-slate-800 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="text-slate-400 font-bold italic">Belum ada pesanan masuk saat ini.</p>
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
</x-app-layout>