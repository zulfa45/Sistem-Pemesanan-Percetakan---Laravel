<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-white">Selamat Datang</h2>
        <p class="text-slate-300 text-sm">Masuk untuk mengelola pesanan Anda</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Email" class="text-slate-200 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 rounded-xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" class="text-slate-200 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 rounded-xl" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-white/30 bg-white/10 text-blue-500 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-slate-300">Ingat saya</span>
            </label>
        </div>

        <div class="mt-8 flex flex-col space-y-4">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20 transition-all transform hover:-translate-y-0.5 border border-blue-500/50">
                Masuk ke Akun
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>