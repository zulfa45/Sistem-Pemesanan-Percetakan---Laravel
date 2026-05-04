@php $width = 'lg:max-w-6xl'; @endphp
<x-guest-layout :width="$width">
    
    <!-- TAMPILAN WEB UTAMA (TIDAK BERUBAH) -->
    <div class="transition-colors duration-300 print:hidden">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-md">Konfirmasi Pesanan</h2>
            <p class="text-slate-200/80 max-w-2xl mx-auto text-sm md:text-base">Terima kasih! Pesanan Anda telah berhasil dikonfirmasi.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Sidebar - Progress Info -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white/5 dark:bg-black/20 backdrop-blur-sm p-6 rounded-3xl border border-white/10">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-white mb-1">Langkah 3 dari 3</h3>
                        <p class="text-blue-300 text-xs font-medium uppercase tracking-widest">Konfirmasi</p>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/40">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <span class="block font-bold text-white text-sm">Detail Pesanan</span>
                                <span class="text-emerald-400 text-[10px] font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/40">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <span class="block font-bold text-white text-sm">Pembayaran</span>
                                <span class="text-emerald-400 text-[10px] font-bold">Terverifikasi</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shadow-lg shadow-blue-600/40">3</div>
                            <div>
                                <span class="block font-bold text-white text-sm">Konfirmasi</span>
                                <span class="text-slate-400 text-[10px]">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-600/10 p-5 rounded-3xl border border-blue-600/20">
                    <p class="text-[11px] text-slate-300 italic leading-relaxed text-center">"Simpan struk ini sebagai bukti pengambilan barang di kasir."</p>
                </div>
            </div>

            <!-- Right - Receipt Content -->
            <div class="lg:col-span-8 flex justify-center">
                <div class="w-full max-w-md bg-white rounded-[2.5rem] shadow-2xl overflow-hidden receipt-card transition-all duration-300">
                    <!-- Header Struk -->
                    <div class="bg-slate-900 p-8 text-center text-white relative receipt-header">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600/20 rounded-full blur-2xl"></div>
                        <img src="{{ asset('images/logo.png') }}" class="h-12 mx-auto mb-3 object-contain relative z-10" alt="Logo">
                        <h1 class="text-xl font-extrabold tracking-tight relative z-10 uppercase">Spektrum Multi Grafika</h1>
                        <p class="text-slate-400 text-[10px] uppercase tracking-[0.2em] mt-1 relative z-10">Digital Printing & Design</p>
                    </div>

                    <!-- Body Struk -->
                    <div class="p-8 pt-6 relative">
                        <!-- Status Badge -->
                        <div class="flex justify-center mb-6">
                            @if($order->status == 'diproses')
                                <div class="flex items-center gap-2 bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full border border-emerald-100">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <span class="text-[10px] font-black uppercase tracking-widest">Lunas & Diproses</span>
                                </div>
                            @elseif($order->status == 'pending')
                                <div class="flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full border border-blue-100">
                                    <span class="text-[10px] font-black uppercase tracking-widest">Menunggu Validasi</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 bg-amber-50 text-amber-600 px-4 py-1.5 rounded-full border border-amber-100">
                                    <span class="text-[10px] font-black uppercase tracking-widest">{{ str_replace('_', ' ', $order->status) }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="text-center mb-8">
                            <p class="text-slate-400 text-[9px] font-bold uppercase tracking-[0.2em] mb-1">Nomor Resi</p>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $order->nomor_resi }}</h2>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500 font-medium">Nama Pelanggan</span>
                                <span class="text-slate-900 font-bold">{{ $order->nama_pelanggan }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500 font-medium">Layanan Cetak</span>
                                <span class="text-slate-900 font-bold text-right">{{ $order->service->nama_jasa }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500 font-medium">Jumlah Pesanan</span>
                                <span class="text-slate-900 font-bold">{{ $order->jumlah }} {{ $order->service->satuan ?? 'Pcs' }}</span>
                            </div>
                            
                            <div class="h-px bg-dashed border-t border-dashed border-slate-200 my-4"></div>

                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Pembayaran</span>
                                <span class="text-2xl font-black text-blue-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 mb-8 text-center">
                            <p class="text-[10px] text-slate-500 leading-relaxed">
                                Tunjukkan halaman ini atau screenshot kepada staf kami saat pengambilan barang untuk proses verifikasi cepat.
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3">
                            <button onclick="window.print()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl transition-all shadow-xl shadow-blue-600/20 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Simpan Struk
                            </button>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-slate-50 py-4 text-center border-t border-slate-100">
                        <p class="text-[10px] text-slate-400 font-medium">Terima kasih telah mempercayai Spektrum Multi Grafika</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        @media print {
            @page { margin: 0; size: auto; }
            
            /* Sembunyikan elemen bawaan web agar tombol "Kembali ke Beranda" hilang sepenuhnya */
            body * {
                visibility: hidden;
            }

            /* Memaksa browser mencetak warna background dan border */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Tampilkan area cetak */
            #print-area-struk, #print-area-struk * {
                visibility: visible;
            }

            #print-area-struk {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                display: flex !important;
                justify-content: center;
                padding: 20px;
                background-color: white !important;
            }

            /* Desain Modern Thermal */
            .print-card {
                width: 100%;
                max-width: 80mm; 
                background: #ffffff !important;
                font-family: 'Inter', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
                /* Aksen Biru Modern di bagian atas */
                border-top: 6px solid #2563eb !important; 
                border-radius: 8px;
                padding-top: 10px;
            }

            /* Header dengan Logo Berwarna */
            .print-header-modern {
                text-align: center;
                padding-bottom: 15px;
            }

            .print-header-modern img {
                max-height: 45px;
                margin: 0 auto 10px auto;
                display: block;
                /* Tanpa grayscale, biarkan berwarna */
            }

            .print-header-modern h1 {
                font-size: 14px;
                font-weight: 800;
                margin: 0 0 3px 0;
                color: #0f172a !important; /* Warna slate-900 */
                letter-spacing: 0.5px;
            }

            .print-header-modern p {
                font-size: 9px;
                color: #64748b !important; /* Warna slate-500 */
                letter-spacing: 1px;
                margin: 0;
            }

            .print-divider {
                border-top: 1.5px dashed #cbd5e1 !important; /* Garis putus-putus halus */
                margin: 15px 0;
            }

            /* Nomor Resi */
            .print-resi-section {
                text-align: center;
                margin: 20px 0;
                background: #f8fafc !important; /* Background abu-abu sangat muda */
                padding: 10px;
                border-radius: 6px;
            }

            .print-resi-label {
                font-size: 9px;
                font-weight: 700;
                color: #3b82f6 !important; /* Biru terang */
                margin: 0 0 4px 0;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .print-resi-value {
                font-size: 24px;
                font-weight: 900;
                color: #0f172a !important;
                margin: 0;
            }

            /* Detail Rows */
            .print-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
                font-size: 12px;
                color: #0f172a !important;
            }

            .print-label { font-weight: 500; color: #475569 !important; }
            .print-value { font-weight: 800; text-align: right; }

            /* Total Bayar */
            .print-total-section {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
            }

            .print-total-label {
                font-size: 11px;
                font-weight: 800;
                color: #475569 !important;
                line-height: 1.2;
            }

            .print-total-value {
                font-size: 22px;
                font-weight: 900;
                color: #2563eb !important; /* Aksen Biru pada harga */
            }

            /* Instruksi Bawah (Kotak Biru Muda) */
            .print-footer-instruction {
                text-align: center;
                margin-top: 25px;
                font-size: 11px;
                font-weight: 700;
                color: #1e3a8a !important; /* Biru sangat gelap */
                background-color: #eff6ff !important; /* Background biru muda */
                padding: 12px;
                border-radius: 6px;
                border: 1px dashed #93c5fd !important;
            }
        }
    </style>
    @endpush

    <!-- AREA KHUSUS CETAK -->
    <div id="print-area-struk" class="hidden">
        <div class="print-card">
            
            <div class="print-header-modern">
                <!-- LOGO BERWARNA -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <h1>SPEKTRUM MULTI GRAFIKA</h1>
                <p>DIGITAL PRINTING & DESIGN</p>
            </div>
            
            <div class="print-divider"></div>

            <div class="print-body">
                
                <div class="print-resi-section">
                    <p class="print-resi-label">NOMOR RESI</p>
                    <h2 class="print-resi-value">{{ $order->nomor_resi }}</h2>
                </div>

                <div class="print-details">
                    <div class="print-row">
                        <span class="print-label">Nama Pelanggan</span>
                        <span class="print-value">{{ $order->nama_pelanggan }}</span>
                    </div>
                    <div class="print-row">
                        <span class="print-label">Layanan Cetak</span>
                        <span class="print-value">{{ $order->service->nama_jasa }}</span>
                    </div>
                    <div class="print-row">
                        <span class="print-label">Jumlah Pesanan</span>
                        <span class="print-value">{{ $order->jumlah }} {{ $order->service->satuan ?? 'Pcs' }}</span>
                    </div>
                </div>

                <div class="print-divider"></div>

                <div class="print-total-section">
                    <div class="print-total-label">TOTAL<br>PEMBAYARAN</div>
                    <div class="print-total-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                </div>

                <div class="print-footer-instruction">
                    Tunjukkan struk ini<br>untuk mengambil pesanan
                </div>
                
            </div>
        </div>
    </div>
</x-guest-layout>