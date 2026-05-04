<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 dark:text-white leading-tight transition-colors">Buat Pesanan Walk-in</h2>
    </x-slot>

    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800 transition-colors">
                <div class="p-8 md:p-12">
                    
                    <div class="mb-10">
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white">Formulir Pesanan Langsung</h3>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">Input data pelanggan yang datang langsung ke toko.</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 p-6 rounded-2xl mb-10 border border-rose-100 dark:border-rose-900/30">
                            <ul class="list-disc list-inside text-sm font-bold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kasir.order.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                        @csrf

                        <!-- Section: Identitas -->
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="w-10 h-[2px] bg-blue-600 dark:bg-blue-400"></span>
                                Identitas Pelanggan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required 
                                        class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                                        placeholder="Nama lengkap...">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">No. WhatsApp</label>
                                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" required 
                                        class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                                        placeholder="08xxxxxxxx">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">Alamat (Opsional untuk Walk-in)</label>
                                <textarea name="alamat" required rows="2" 
                                    class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                                    placeholder="Tulis '-' jika tidak diperlukan...">{{ old('alamat') }}</textarea>
                            </div>
                        </div>

                        <!-- Section: Detail Jasa -->
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="w-10 h-[2px] bg-blue-600 dark:bg-blue-400"></span>
                                Spesifikasi Cetakan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">Pilih Layanan</label>
                                    <select name="service_id" required 
                                        class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                                        <option value="">-- Pilih Layanan --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->nama_jasa }} (Rp {{ number_format($service->harga) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">Jumlah</label>
                                    <input type="number" name="jumlah" min="1" value="{{ old('jumlah') ?? 1 }}" required 
                                        class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">Catatan Tambahan</label>
                                <textarea name="catatan" rows="2" 
                                    class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                                    placeholder="Instruksi khusus cetakan...">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        <!-- Section: Pembayaran & File -->
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="w-10 h-[2px] bg-blue-600 dark:bg-blue-400"></span>
                                Pembayaran & File
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" required 
                                        class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                                        <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>💰 Cash (Tunai)</option>
                                        <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>🏦 Transfer Bank</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 ml-1">File Desain (PDF/JPG/ZIP) <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                                    <input type="file" name="file_desain" 
                                        class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer border border-slate-200 dark:border-slate-700 rounded-2xl bg-slate-50 dark:bg-slate-800">
                                </div>
                            </div>
                            <div class="p-6 bg-blue-50 dark:bg-blue-900/20 rounded-3xl border border-blue-100 dark:border-blue-800">
                                <p class="text-sm font-bold text-blue-800 dark:text-blue-300 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Info: Jika metode Cash dipilih, status pesanan akan langsung menjadi "Diproses".
                                </p>
                            </div>
                        </div>

                        <div class="pt-6 flex gap-4">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-3xl shadow-xl shadow-blue-600/20 transition-all transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Pesanan & Proses
                            </button>
                            <a href="{{ route('kasir.dashboard') }}" class="bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-black py-5 px-10 rounded-3xl transition-all">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>