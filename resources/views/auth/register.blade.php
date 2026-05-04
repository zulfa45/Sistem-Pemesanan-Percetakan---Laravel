<!-- <x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-white">Daftar Akun</h2>
        <p class="text-slate-300 text-sm">Bergabung dengan Spektrum Multi Grafika</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Lengkap" class="text-slate-200 font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 rounded-xl" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" class="text-slate-200 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 rounded-xl" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" class="text-slate-200 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 rounded-xl" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-slate-200 font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 rounded-xl" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-8 flex flex-col space-y-4">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20 transition-all transform hover:-translate-y-0.5 border border-blue-500/50">
                Buat Akun Baru
            </x-primary-button>

            <div class="text-center">
                <p class="text-sm text-slate-300">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-400 font-bold hover:text-blue-300 hover:underline transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>
    </form>
</x-guest-layout> -->