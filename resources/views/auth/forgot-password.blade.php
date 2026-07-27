<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan link reset password yang memungkinkan Anda memilih password baru.') }}
    </div>

    <!-- Session Status (Notif hijau yang udah diterjemahin) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <!-- TOMBOL KEMBALI -->
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0E4D2B]" href="{{ route('login') }}">
                Kembali ke Login
            </a>

            <button type="submit" class="bg-[#0E4D2B] hover:bg-[#2E7D32] text-white font-bold py-2 px-4 rounded transition">
                Konfirmasi Reset Password
            </button>
        </div>
    </form>
</x-guest-layout>