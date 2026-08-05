@php
    $isOp = Auth::user()->role === 'operator';
    $bgAva = $isOp ? 'FBC02D' : 'A5D6A7';
    $rawAvatar = Auth::user()->avatar;
    
    // Logika avatar utama (pakai raw kalau ada dan http, sisanya pakai inisial dengan warna sesuai role)


    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . "&color=0E4D2B&background={$bgAva}&bold=true";

        
    // Logika fallback error (wajib dikirim bareng warna sesuai role)
    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . "&color=0E4D2B&background={$bgAva}&bold=true";
@endphp
<nav x-data="{ open: false }" class="bg-white border-b-4 border-[#0E4D2B] shadow-sm relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/pemkab-logo.png') }}" class="block h-8 sm:h-12 w-auto" alt="Logo Pemkab" />
                    <img src="{{ asset('images/logo-ubp.png') }}" class="block h-8 sm:h-12 w-auto" alt="Logo UBP" />
                    <img src="{{ asset('images/logo-kkn.png') }}" class="block h-8 sm:h-12 w-auto" alt="Logo KKN" />
                    <div class="ml-1 sm:ml-2">
                        <div class="font-bold text-[#0E4D2B] text-sm sm:text-lg leading-tight">Portal Tanjungmekar</div>
                        <div class="text-[10px] sm:text-sm text-[#66BB6A] font-semibold tracking-wide">KKN UBP Karawang 2026</div>
                    </div>
                </a>
            </div>

            <div class="hidden lg:flex lg:items-center lg:gap-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('pemetaan')" :active="request()->routeIs('pemetaan')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                    {{ __('Peta Wilayah') }}
                </x-nav-link>
                <x-nav-link :href="route('faq')" :active="request()->routeIs('faq')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                    {{ __('Pusat FAQ') }}
                </x-nav-link>
                
                @if(Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator')
                    <x-nav-link :href="route('laporan-web')" :active="request()->routeIs('laporan-web')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                        {{ __('Layanan') }}
                    </x-nav-link>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-4 font-bold rounded-full text-gray-700 bg-gray-50 hover:text-[#0E4D2B] hover:border-[#0E4D2B] focus:outline-none transition">
                            <div class="w-7 h-7 rounded-full bg-[#{{ $bgAva }}] mr-2 flex items-center justify-center overflow-hidden border border-[#0E4D2B]">

                                <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(str_starts_with(Auth::user()->avatar, 'storage/') ? Auth::user()->avatar : 'storage/' . Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">

                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-semibold text-gray-700">{{ __('Profil Saya') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="font-semibold text-red-600">{{ __('Sign Out') }}</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#0E4D2B] focus:outline-none transition">
                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Modifikasi Absolute Position agar menimpa konten -->
    <div x-show="open" x-transition style="display: none;" class="absolute w-full left-0 top-[100%] lg:hidden bg-white shadow-2xl z-50 border-b-4 border-[#0E4D2B]">
        <div class="px-4 pt-4 pb-6 space-y-1">
            <!-- Profil diurutkan menjadi paling atas -->
            <div class="mb-5 pb-5 border-b border-gray-200">
                <div class="flex items-center gap-3 px-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-[#{{ $bgAva }}] overflow-hidden border-2 border-[#0E4D2B]">

                        <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(str_starts_with(Auth::user()->avatar, 'storage/') ? Auth::user()->avatar : 'storage/' . Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">

                    </div>
                    <div>
                        <div class="font-bold text-lg text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <x-responsive-nav-link :href="route('profile.edit')" class="font-semibold text-gray-700">{{ __('Profil Saya') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-bold">{{ __('Sign Out') }}</x-responsive-nav-link>
                </form>
            </div>

            <!-- Menu Navigasi di bawah profil -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pemetaan')" :active="request()->routeIs('pemetaan')">{{ __('Peta Wilayah') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faq')" :active="request()->routeIs('faq')">{{ __('Pusat FAQ') }}</x-responsive-nav-link>
            
            @if(Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator')
                <x-responsive-nav-link :href="route('laporan-web')" :active="request()->routeIs('laporan-web')">{{ __('Layanan') }}</x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>