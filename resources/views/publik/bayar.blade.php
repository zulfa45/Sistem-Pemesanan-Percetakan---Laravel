@php $width = 'lg:max-w-6xl'; @endphp
<x-guest-layout :width="$width">
    <div class="transition-colors duration-300">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-md">Konfigurasi Pesanan</h2>
            <p class="text-slate-200/80 max-w-2xl mx-auto text-sm md:text-base">Selesaikan pembayaran untuk memproses pesanan Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Sidebar - Progress Info -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white/5 dark:bg-black/20 backdrop-blur-sm p-6 rounded-3xl border border-white/10">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-white mb-1">Langkah 2 dari 3</h3>
                        <p class="text-blue-300 text-xs font-medium uppercase tracking-widest">Pembayaran</p>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4 opacity-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/40">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <span class="block font-bold text-white text-sm">Detail Pesanan</span>
                                <span class="text-emerald-400 text-[10px] font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shadow-lg shadow-blue-600/40">2</div>
                            <div>
                                <span class="block font-bold text-white text-sm">Pembayaran</span>
                                <span class="text-slate-400 text-[10px]">Pilih Metode</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 opacity-40">
                            <div class="w-10 h-10 rounded-xl bg-white/10 text-white flex items-center justify-center font-bold">3</div>
                            <div>
                                <span class="block font-bold text-slate-300 text-sm">Konfirmasi</span>
                                <span class="text-slate-500 text-[10px]">Cetak Struk</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Mini Card -->
                <div class="bg-white/5 p-6 rounded-3xl border border-white/10">
                    <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-4">
                        <span class="text-blue-400 font-bold uppercase tracking-widest text-[10px]">Ringkasan</span>
                        <span class="text-white font-mono text-xs bg-blue-600 px-3 py-1 rounded-full shadow-lg shadow-blue-600/30">{{ $order->nomor_resi }}</span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-400">Total Tagihan</span>
                            <span class="text-white font-black text-lg">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right - Payment Action -->
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white/5 p-6 rounded-3xl border border-white/5 text-center lg:text-left">
                    <h4 class="text-xl font-bold text-white mb-2">Pilih Metode Pembayaran</h4>
                    <p class="text-slate-300 text-xs leading-relaxed">Silakan selesaikan pembayaran aman Anda melalui Midtrans atau gunakan transfer manual sebagai alternatif.</p>
                </div>

                <div class="space-y-4">
                    <button id="pay-button" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-emerald-600/30 flex justify-center items-center gap-3 transition-all transform hover:-translate-y-1 active:scale-[0.98] text-lg uppercase tracking-widest">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Bayar Sekarang
                    </button>
                    
                    <div x-data="{ open: false }" class="border border-white/10 rounded-2xl overflow-hidden bg-white/5">
                        <button @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between text-slate-300 hover:text-white transition-colors">
                            <span class="text-[10px] font-black uppercase tracking-widest">Konfirmasi Transfer Manual</span>
                            <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" x-collapse x-cloak class="px-6 pb-6 pt-2 space-y-4 border-t border-white/5">
                            <div class="bg-blue-600/10 p-4 rounded-xl text-center">
                                <p class="text-[10px] text-blue-400 mb-1 font-bold uppercase tracking-widest">Transfer BCA</p>
                                <p class="text-white font-black text-xl">1234567890</p>
                            </div>

                            <form action="{{ route('pesan.prosesBayar', $order->nomor_resi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Bukti Bayar</label>
                                    <input type="file" name="bukti_pembayaran" required class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white bg-white/5 border border-white/10 rounded-xl">
                                    <input type="hidden" name="metode_pembayaran" value="Manual Transfer">
                                </div>
                                <button type="submit" class="w-full py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl text-xs uppercase tracking-widest">
                                    Kirim Bukti
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            // SnapToken acquired from previous step
            snap.pay('{{ $order->snap_token }}', {
                // Optional
                onSuccess: function(result){
                    /* You may add your own implementation here */
                    window.location.href = "{{ route('struk.show', $order->nomor_resi) }}?status=success";
                },
                // Optional
                onPending: function(result){
                    /* You may add your own implementation here */
                    window.location.href = "{{ route('struk.show', $order->nomor_resi) }}?status=pending";
                },
                // Optional
                onError: function(result){
                    /* You may add your own implementation here */
                    alert("Pembayaran gagal! Silakan coba lagi.");
                },
                onClose: function(){
                    /* You may add your own implementation here */
                    alert('Anda menutup jendela pembayaran sebelum selesai.');
                }
            });
        };
    </script>
    @endpush
</x-guest-layout>