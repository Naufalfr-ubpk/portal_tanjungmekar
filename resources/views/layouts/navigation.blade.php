<nav x-data="{ open: false }" class="bg-white border-b-4 border-[#0E4D2B] shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo-kkn.png') }}" class="block h-12 w-auto" alt="Logo KKN" />
                        <span class="font-bold text-[#0E4D2B] text-lg hidden sm:block">Portal Tanjungmekar</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pemetaan')" :active="request()->routeIs('pemetaan')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                        {{ __('Peta Wilayah') }}
                    </x-nav-link>
                    <x-nav-link :href="route('faq')" :active="request()->routeIs('faq')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                        {{ __('Pusat FAQ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('laporan-web')" :active="request()->routeIs('laporan-web')" class="text-sm font-bold text-gray-700 hover:text-[#0E4D2B]">
                        {{ __('Layanan') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-4 font-bold rounded-full text-gray-700 bg-gray-50 hover:text-[#0E4D2B] hover:border-[#0E4D2B] focus:outline-none transition ease-in-out duration-150">
                            <div class="w-7 h-7 rounded-full bg-gray-300 mr-2 flex items-center justify-center overflow-hidden border border-[#0E4D2B]">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background=A5D6A7&bold=true" alt="Avatar" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')" class="font-semibold text-gray-700">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')" class="font-semibold text-gray-700">
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="font-semibold text-red-600">
                                {{ __('Keluar Akun') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>