@php $width = 'lg:max-w-6xl'; @endphp
<x-guest-layout :width="$width">
    <div class="transition-colors duration-300">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-md">Konfigurasi Pesanan</h2>
            <p class="text-slate-200/80 max-w-2xl mx-auto text-sm md:text-base">Lengkapi detail di bawah untuk proses percetakan profesional.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Sidebar - Progress Info -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white/5 dark:bg-black/20 backdrop-blur-sm p-6 rounded-3xl border border-white/10">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-white mb-1">Langkah 1 dari 3</h3>
                        <p class="text-blue-300 text-xs font-medium uppercase tracking-widest">Informasi Dasar</p>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shadow-lg shadow-blue-600/40">1</div>
                            <div>
                                <span class="block font-bold text-white text-sm">Detail Pesanan</span>
                                <span class="text-slate-400 text-[10px]">Data & File</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 opacity-40">
                            <div class="w-10 h-10 rounded-xl bg-white/10 text-white flex items-center justify-center font-bold">2</div>
                            <div>
                                <span class="block font-bold text-slate-300 text-sm">Pembayaran</span>
                                <span class="text-slate-500 text-[10px]">Pilih Metode</span>
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

                <div class="hidden lg:block bg-blue-600/10 p-5 rounded-3xl border border-blue-600/20">
                    <p class="text-[11px] text-slate-300 italic leading-relaxed text-center">"Kualitas premium dengan proses yang transparan."</p>
                </div>
            </div>

            <!-- Right - Form Content -->
            <div class="lg:col-span-8">
                @if ($errors->any())
                    <div class="bg-red-500/20 backdrop-blur-md text-red-200 p-5 rounded-2xl mb-6 border border-red-500/30">
                        <ul class="list-disc list-inside text-xs font-semibold space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('pesan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-200 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required 
                                class="block w-full px-5 py-3.5 rounded-2xl border-white/10 bg-white/5 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-blue-500 transition-all outline-none"
                                placeholder="Budi Santoso">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-200 uppercase tracking-widest ml-1">Nomor HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required 
                                class="block w-full px-5 py-3.5 rounded-2xl border-white/10 bg-white/5 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-blue-500 transition-all outline-none"
                                placeholder="0812xxxxxx">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-200 uppercase tracking-widest ml-1">Alamat</label>
                        <textarea name="alamat" required rows="2" 
                            class="block w-full px-5 py-3.5 rounded-2xl border-white/10 bg-white/5 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-blue-500 transition-all outline-none"
                            placeholder="Alamat detail...">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-200 uppercase tracking-widest ml-1">Pilih Jasa</label>
                            <select name="service_id" required 
                                class="block w-full px-5 py-3.5 rounded-2xl border-white/10 bg-white/5 text-white focus:border-blue-500 focus:ring-blue-500 transition-all outline-none appearance-none cursor-pointer">
                                <option value="" class="bg-slate-900">-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ (old('service_id') ?? $selectedServiceId) == $service->id ? 'selected' : '' }} class="bg-slate-900">
                                        {{ $service->nama_jasa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-200 uppercase tracking-widest ml-1">Jumlah</label>
                            <input type="number" name="jumlah" min="1" value="{{ old('jumlah') ?? 1 }}" required 
                                class="block w-full px-5 py-3.5 rounded-2xl border-white/10 bg-white/5 text-white focus:border-blue-500 focus:ring-blue-500 transition-all outline-none"
                                placeholder="Jumlah">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-200 uppercase tracking-widest ml-1">
                                File Desain <span class="text-[10px] font-normal text-slate-400 normal-case tracking-normal">(Opsional)</span>
                            </label>
                            <input type="file" name="file_desain" 
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white bg-white/5 border border-white/10 rounded-2xl">
                            <p class="text-[10px] text-slate-400 ml-1 mt-1 leading-tight">Unggah file desain jika layanan yang Anda pilih membutuhkannya (misal: Cetak MMT). Kosongkan jika tidak perlu.</p>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-200 uppercase tracking-widest ml-1">
                                Foto KTP <span class="text-[10px] font-normal text-red-400 normal-case tracking-normal">* Wajib</span>
                            </label>
                            <input type="file" name="foto_ktp" accept="image/*" required 
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white bg-white/5 border border-white/10 rounded-2xl">
                            <p class="text-[10px] text-slate-400 ml-1 mt-1 leading-tight">Mohon lampirkan foto KTP untuk keperluan verifikasi identitas pemesan dan keamanan transaksi.</p>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-blue-600/30 flex justify-center items-center gap-3 transition-all transform hover:-translate-y-1 active:scale-[0.98] text-sm uppercase tracking-widest">
                            Lanjut ke Pembayaran
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>