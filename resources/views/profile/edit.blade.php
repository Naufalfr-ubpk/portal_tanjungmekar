<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Profil Saya') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex items-center gap-6">
                <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden border-2 border-[#0E4D2B]">
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background=A5D6A7&bold=true';">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    <span class="inline-block mt-2 px-3 py-1 bg-[#A5D6A7] text-[#0E4D2B] text-xs font-bold rounded-full">Warga Terdaftar</span>
                </div>
            </div>
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @if(Auth::user()->password != null)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>