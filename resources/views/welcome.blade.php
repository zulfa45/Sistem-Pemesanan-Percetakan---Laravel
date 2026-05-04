<!DOCTYPE html>
<html lang="id" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spektrum Multi Grafika - Solusi Percetakan Profesional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>
        // Check theme on load to prevent flash
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-bg {
            background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url("{{ asset('images/background.png') }}");
            background-size: cover;
            background-position: center;
        }
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            transition: all 0.3s ease;
        }
        .whatsapp-float:hover {
            transform: scale(1.1) translateY(-5px);
        }
    </style>
</head>
<body class="antialiased text-slate-900 bg-white dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6285210335432" target="_blank" class="whatsapp-float group">
        <div class="relative">
            <div class="absolute inset-0 bg-green-500 rounded-full animate-ping opacity-25 group-hover:opacity-40"></div>
            <div class="relative bg-green-500 text-white p-4 rounded-full shadow-2xl flex items-center justify-center border-2 border-white dark:border-slate-800">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.438 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.438-9.89 9.886-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 1.744-.457zm11.387-5.464c-.307-.154-1.817-.897-2.098-.998-.281-.103-.485-.154-.689.154-.204.307-.791.998-.97 1.203-.178.205-.357.23-.664.077-.307-.154-1.296-.478-2.469-1.521-.913-.813-1.53-1.817-1.709-2.124-.178-.307-.019-.473.135-.625.138-.138.307-.359.461-.538.154-.179.204-.308.307-.513.103-.205.051-.385-.026-.538-.077-.154-.689-1.666-.944-2.28-.248-.599-.5-.519-.689-.529-.178-.01-.383-.01-.587-.01s-.537.077-.817.385c-.281.307-1.074 1.051-1.074 2.564 0 1.512 1.1 2.974 1.253 3.179.154.205 2.165 3.306 5.245 4.64.732.317 1.304.507 1.749.649.734.233 1.403.2 1.932.121.589-.088 1.817-.743 2.072-1.461.255-.718.255-1.333.178-1.461-.077-.128-.281-.205-.588-.359z"/></svg>
            </div>
        </div>
    </a>

    <nav x-data="{ scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
         :class="scrolled ? 'bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-sm py-3' : 'bg-transparent py-5'"
         class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Spektrum Multi Grafika" class="h-10 w-auto object-contain transition-transform duration-300 hover:scale-105">
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#fitur" :class="scrolled ? 'text-slate-600 dark:text-slate-300' : 'text-slate-200'" class="hover:text-blue-500 font-medium transition-colors">Fitur</a>
                    <a href="#layanan" :class="scrolled ? 'text-slate-600 dark:text-slate-300' : 'text-slate-200'" class="hover:text-blue-500 font-medium transition-colors">Layanan</a>
                    
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode" class="p-2 rounded-lg transition-colors" :class="scrolled ? 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' : 'text-slate-200 hover:bg-white/10'">
                        <template x-if="!darkMode">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </template>
                        <template x-if="darkMode">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m3.343-5.657l-.707.707m12.728 12.728l-.707.707M6.343 17.657l-.707-.707M17.657 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </template>
                    </button>

                    <a href="{{ route('pesan.form') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-full font-semibold transition shadow-lg shadow-blue-500/30">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-bg min-h-screen flex items-center relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20">
            <div class="max-w-3xl">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 text-sm font-semibold mb-6 tracking-wide uppercase">
                    Pusat Percetakan Digital Terbaik
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-8">
                    Wujudkan Ide Anda dalam <span class="text-blue-400">Kualitas Sempurna</span>
                </h1>
                <p class="text-xl text-slate-300 mb-10 leading-relaxed">
                    Spektrum Multi Grafika menghadirkan solusi percetakan terintegrasi untuk kebutuhan bisnis dan personal Anda. Cepat, berkualitas, dan kini bisa dipesan langsung dari rumah.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('pesan.form') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold transition-all transform hover:-translate-y-1 shadow-xl shadow-blue-600/20">
                        Pesan Sekarang
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="#layanan" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white text-lg font-bold border border-white/30 transition-all">
                        Lihat Katalog
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-24 bg-white dark:bg-slate-950 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Layanan Unggulan Kami</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
                <p class="mt-4 text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Pilih berbagai jenis layanan cetak berkualitas tinggi untuk kebutuhan bisnis dan personal Anda.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="group bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-video relative overflow-hidden">
                        @if($service->gambar)
                            <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama_jasa }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.587-1.587a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                Rp {{ number_format($service->harga, 0, ',', '.') }}/{{ $service->satuan }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">{{ $service->nama_jasa }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 line-clamp-2 italic">{{ $service->deskripsi }}</p>
                        <a href="{{ route('pesan.form', ['service_id' => $service->id]) }}" class="block w-full text-center py-3 rounded-xl bg-slate-50 dark:bg-slate-800 text-blue-600 dark:text-blue-400 font-bold hover:bg-blue-600 hover:text-white transition-colors border border-blue-100 dark:border-slate-700">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="fitur" class="py-24 bg-slate-50 dark:bg-slate-900/50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Mengapa Memilih Kami?</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
            </div>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-6 text-blue-600 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 dark:text-white">Proses Kilat</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Sistem manajemen pesanan kami memastikan setiap proyek diproses dengan efisiensi maksimal.</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-6 text-blue-600 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 dark:text-white">Kualitas Premium</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Menggunakan teknologi cetak terkini untuk menghasilkan warna yang tajam dan material yang tahan lama.</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-6 text-blue-600 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402-2.599-1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 dark:text-white">Harga Kompetitif</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Harga transparan yang sesuai dengan kualitas yang Anda dapatkan tanpa biaya tersembunyi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION LOKASI -->
    <section id="lokasi" class="py-24 bg-white dark:bg-slate-950 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Info Lokasi -->
                <div class="space-y-8 order-2 lg:order-1">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-4">Kunjungi Workshop Kami</h2>
                        <div class="w-20 h-1.5 bg-blue-600 rounded-full mb-6"></div>
                        <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                            Kami siap melayani kebutuhan cetak Anda secara langsung. Datang dan konsultasikan project Anda dengan tim ahli kami di lokasi yang strategis dan nyaman.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white">Alamat Kami</h4>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">No Jl. Sulawesi No.32, Sidowayah, Kabupaten, Kec. Klaten Tengah, Kabupaten Klaten, Jawa Tengah 57413</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white">Jam Operasional</h4>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.438 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.438-9.89 9.886-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 1.744-.457zm11.387-5.464c-.307-.154-1.817-.897-2.098-.998-.281-.103-.485-.154-.689.154-.204.307-.791.998-.97 1.203-.178.205-.357.23-.664.077-.307-.154-1.296-.478-2.469-1.521-.913-.813-1.53-1.817-1.709-2.124-.178-.307-.019-.473.135-.625.138-.138.307-.359.461-.538.154-.179.204-.308.307-.513.103-.205.051-.385-.026-.538-.077-.154-.689-1.666-.944-2.28-.248-.599-.5-.519-.689-.529-.178-.01-.383-.01-.587-.01s-.537.077-.817.385c-.281.307-1.074 1.051-1.074 2.564 0 1.512 1.1 2.974 1.253 3.179.154.205 2.165 3.306 5.245 4.64.732.317 1.304.507 1.749.649.734.233 1.403.2 1.932.121.589-.088 1.817-.743 2.072-1.461.255-.718.255-1.333.178-1.461-.077-.128-.281-.205-.588-.359z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white">WhatsApp</h4>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">085210335432</p>
                            </div>
                        </div>
                        </div>

                        <div class="pt-4">
                        <a href="https://www.google.com/maps/place/Spektrum+Multi+Grafika/@-7.7024219,110.5976961,18z" target="_blank" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition-all transform hover:-translate-y-1 shadow-lg shadow-blue-600/20">
                            Buka di Google Maps
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Peta Embed -->
                <div class="order-1 lg:order-2">
                    <div class="relative w-full h-[450px] rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white dark:border-slate-900 shadow-blue-500/10">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.522204689456!2d110.5951211758957!3d-7.702421892315132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a440a0b01d745%3A0x17e727186fbc0238!2sSpektrum%20Multi%20Grafika!5e0!3m2!1sid!2sid!4v1714650000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 dark:bg-slate-950 py-12 border-t border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 text-center">
            
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Spektrum Multi Grafika" class="h-14 w-auto object-contain opacity-80 hover:opacity-100 transition-opacity duration-300">
            </div>

            <p class="text-slate-400 dark:text-slate-500 mb-8">&copy; 2026 Spektrum Multi Grafika. Semua Hak Dilindungi.</p>
            <div class="flex justify-center space-x-6">
                <a href="#" class="text-slate-500 hover:text-white dark:hover:text-blue-400 transition-colors text-sm">Syarat & Ketentuan</a>
                <a href="#" class="text-slate-500 hover:text-white dark:hover:text-blue-400 transition-colors text-sm">Kebijakan Privasi</a>
            </div>
        </div>
    </footer>

</body>
</html>