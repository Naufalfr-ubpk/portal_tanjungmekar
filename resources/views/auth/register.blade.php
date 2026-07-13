<x-guest-layout>
    <div class="absolute top-4 left-4 sm:top-8 sm:left-8">
        <a href="/" class="flex items-center text-gray-500 hover:text-[#0E4D2B] transition-colors group">
            <svg class="w-6 h-6 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="text-sm font-semibold">Kembali</span>
        </a>
    </div>

    <div class="flex flex-col items-center mb-6 mt-8 sm:mt-0">
        <a href="/">
            <img src="{{ asset('images/logo-kkn.png') }}" alt="Logo KKN" class="w-24 h-24 object-contain drop-shadow-md hover:scale-105 transition-transform">
        </a>
        <h2 class="mt-4 text-2xl font-bold text-[#0E4D2B]">Daftar Akun Baru</h2>
        <p class="text-sm text-gray-500">Mari bergabung bersama kami</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[#0E4D2B] font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full border-[#A5D6A7] focus:border-[#2E7D32] focus:ring-[#2E7D32]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-[#0E4D2B] font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-[#A5D6A7] focus:border-[#2E7D32] focus:ring-[#2E7D32]" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="text-[#0E4D2B] font-semibold" />
            <div class="relative">
                <x-text-input id="password" x-bind:type="show ? 'text' : 'password'" class="block mt-1 w-full border-[#A5D6A7] focus:border-[#2E7D32] focus:ring-[#2E7D32] pr-10" name="password" required autocomplete="new-password" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#2E7D32]">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg x-show="show" class="w-5 h-5" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-[#0E4D2B] font-semibold" />
            <div class="relative">
                <x-text-input id="password_confirmation" x-bind:type="show ? 'text' : 'password'" class="block mt-1 w-full border-[#A5D6A7] focus:border-[#2E7D32] focus:ring-[#2E7D32] pr-10" name="password_confirmation" required autocomplete="new-password" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#2E7D32]">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg x-show="show" class="w-5 h-5" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-2.5 bg-[#FBC02D] border border-transparent rounded-md font-bold text-sm text-[#0E4D2B] shadow-sm hover:bg-yellow-500 focus:outline-none transition ease-in-out duration-150">
                Daftar Sekarang
            </button>
        </div>

        <div class="mt-6 flex items-center justify-between">
            <span class="border-b w-1/5 lg:w-1/4"></span>
            <a href="#" class="text-xs text-center text-gray-500 uppercase">ATAU</a>
            <span class="border-b w-1/5 lg:w-1/4"></span>
        </div>

        <a href="/auth/google" class="w-full mt-4 flex items-center justify-center gap-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
            Daftar dengan Google
        </a>

        <p class="mt-6 text-center text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#2E7D32] font-bold hover:underline">Login di sini</a></p>
    </form>
</x-guest-layout>