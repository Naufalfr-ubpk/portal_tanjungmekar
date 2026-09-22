@php
    $cachedHero = \Illuminate\Support\Facades\Cache::get('hero_image_url');
    $heroImage = $cachedHero ? $cachedHero : asset('images/kelurahan.png');
@endphp


<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Tanjungmekar | KKN UBP Karawang 2026</title>
    
    <!-- Favicon KKN -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-kkn.png') }}">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        /* Custom Scrollbar Global Biar Elegan dan Gak Ngebug */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F4F8F4; }
        ::-webkit-scrollbar-thumb { background-color: #A5D6A7; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background-color: #2E7D32; }
    </style>
</head>
<body class="font-sans antialiased bg-[#F4F8F4] text-gray-900">

    <!-- Tambah relative di nav biar absolute dropdown patokannya ke sini -->
    <nav x-data="{ openMobileMenu: false }" class="bg-white shadow-md border-b-4 border-[#0E4D2B] sticky top-0 z-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 sm:h-24">
                
                <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-4 group cursor-pointer">
                    <img src="{{ asset('images/pemkab-logo.png') }}" alt="Logo Pemkab" class="h-8 sm:h-14 w-auto object-contain">
                    <img src="{{ asset('images/logo-ubp.png') }}" alt="Logo UBP" class="h-8 sm:h-14 w-auto object-contain">
                    <img src="{{ asset('images/logo-kkn.png') }}" alt="Logo KKN" class="h-8 sm:h-14 w-auto object-contain">
                    <div class="ml-1 sm:ml-3">
                        <h1 class="text-base sm:text-2xl font-bold text-[#0E4D2B] leading-tight">Portal Tanjungmekar</h1>
                        <p class="text-[10px] sm:text-sm text-[#66BB6A] font-semibold tracking-wide">KKN UBP Karawang 2026</p>
                    </div>
                </a>


                
                   <div class="hidden lg:flex items-center gap-6 text-sm font-semibold text-[#0E4D2B]">
                    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'operator'))
                        <a href="{{ route('dashboard') }}" class="hover:text-[#66BB6A] transition">Dashboard</a>
                    @endif

                    <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="hover:text-[#66BB6A] transition">Peta Wilayah</a>
                    <a href="{{ Auth::check() ? route('user.bank-sampah') : route('register') }}" class="hover:text-[#66BB6A] transition">Bank Sampah</a>
                    <a href="{{ Auth::check() ? route('faq') : route('register') }}" class="hover:text-[#66BB6A] transition">Pusat FAQ</a>

                    @if(!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator'))
                        <a href="{{ Auth::check() ? route('laporan-web') : route('register') }}" class="hover:text-[#66BB6A] transition">Layanan (Web)</a>
                    @endif


                    @auth



                        @php


                            $isOp = Auth::user()->role === 'operator';
                            $bgAva = $isOp ? 'FBC02D' : 'A5D6A7';
                            $bgClass = $isOp ? 'bg-[#FBC02D]' : 'bg-[#A5D6A7]';
                            $rawAvatar = Auth::user()->avatar;

                            $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . "&color=0E4D2B&background={$bgAva}&bold=true";

                        @endphp
                        <div x-data="{ openProfile: false }" class="relative ml-4">
                            <button @click="openProfile = !openProfile" class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition">
                                <div class="w-8 h-8 rounded-full {{ $bgClass }} flex items-center justify-center overflow-hidden border border-[#0E4D2B]">

                                    <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : '/storage/' . str_replace('storage/', '', Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">

                                </div>



                                <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                                <!-- Efek Putar Alpine JS -->
                                <svg :class="{'rotate-180': openProfile}" class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openProfile" @click.away="openProfile = false" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Profil Saya</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 font-semibold">Sign Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 ml-2">
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-[#0E4D2B] bg-transparent border-2 border-[#0E4D2B] rounded-full hover:bg-[#0E4D2B] hover:text-white transition-all">Login</a>
                            <a href="{{ route('register') }}" class="text-center py-2.5 px-6 text-sm font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full shadow hover:bg-yellow-500 transition-all">Sign Up</a>
                        </div>
                    @endauth
                </div>

                <div class="lg:hidden flex items-center">
                    <button @click="openMobileMenu = !openMobileMenu" class="text-[#0E4D2B] focus:outline-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!openMobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="openMobileMenu" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Penambahan absolute, w-full, left-0, dan shadow-2xl biar menunya ngambang di atas konten -->
        <div x-show="openMobileMenu" x-transition style="display: none;" class="absolute w-full left-0 top-[100%] lg:hidden bg-white border-b-4 border-[#0E4D2B] shadow-2xl z-50">
            <div class="px-4 pt-4 pb-6 space-y-1">



               @auth
                    @php
                        $isOp = Auth::user()->role === 'operator';
                        $bgAva = $isOp ? 'FBC02D' : 'A5D6A7';
                        $bgClass = $isOp ? 'bg-[#FBC02D]' : 'bg-[#A5D6A7]';
                        $rawAvatar = Auth::user()->avatar;

                        $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . "&color=0E4D2B&background={$bgAva}&bold=true";


                    @endphp
                    <div class="mb-5 pb-5 border-b border-gray-200">
                        <div class="flex items-center gap-3 px-3 mb-4">
                            <div class="w-12 h-12 rounded-full {{ $bgClass }} overflow-hidden border-2 border-[#0E4D2B]">

                                <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : '/storage/' . str_replace('storage/', '', Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">

                            </div>



                            <span class="font-bold text-gray-800 text-lg">{{ Auth::user()->name }}</span>
                        </div>
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2.5 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2.5 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2.5 rounded-md text-base font-bold text-red-600 hover:bg-gray-50">Sign Out</button>
                        </form>
                    </div>
                @endauth



               @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'operator'))
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-bold text-[#0E4D2B] hover:bg-gray-50">Dashboard</a>
                @endif

                <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Peta Wilayah</a>
                <a href="{{ Auth::check() ? route('user.bank-sampah') : route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Bank Sampah</a>
                <a href="{{ Auth::check() ? route('faq') : route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Pusat FAQ</a>

                @if(!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator'))
                    <a href="{{ Auth::check() ? route('laporan-web') : route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Layanan (Web)</a>
                @endif



                @guest
                    <div class="flex flex-col gap-3 mt-5 pt-5 border-t border-gray-200 px-3">
                        <a href="{{ route('login') }}" class="text-center py-2.5 text-sm font-bold text-[#0E4D2B] bg-transparent border-2 border-[#0E4D2B] rounded-full hover:bg-[#0E4D2B] hover:text-white active:bg-[#0E4D2B] active:text-white transition-all">Login</a>
                        <a href="{{ route('register') }}" class="text-center py-2.5 px-6 text-sm font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full shadow hover:bg-yellow-500 transition-all">Sign Up</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- SETTING HERO SECTION: Background Kolase + Overlay Transparan -->
    <main class="relative overflow-hidden bg-[#0E4D2B] bg-no-repeat" style="background-image: url('{{ asset('images/hero-kolase.png') }}'); background-size: auto 85%; background-position: center top 20px;">
        
        <!-- Kaca Film Hijau Transparan -->
        <!-- bg-opacity-85 untuk warna 85% hijau dan 15% nembus ke gambar kolase -->
        <div class="absolute inset-0 bg-[#0E4D2B] bg-opacity-85"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="pt-8 pb-4 md:pt-14 md:pb-6 flex flex-col lg:flex-row lg:items-center lg:gap-12">
                
                <div class="order-first lg:order-last w-full lg:w-1/2 relative mb-8 lg:mb-0">


                    <div class="aspect-w-16 aspect-h-9 sm:aspect-h-10 rounded-2xl overflow-hidden shadow-2xl border-4 border-[#2E7D32]">
                        <img src="{{ $heroImage }}" alt="Lingkungan Bersih Tanjungmekar" class="object-cover w-full h-full">
                    </div>


                </div>

                <div class="order-last lg:order-first text-center lg:text-left lg:w-1/2">
                    <h2 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl leading-tight mb-4 sm:mb-6">
                        Sistem Informasi <br>
                        <span class="text-[#FBC02D]">Geografis & Bank Sampah</span>
                    </h2>
                    <p class="mt-4 text-sm sm:text-lg text-[#F4F8F4] md:text-xl font-medium max-w-2xl mx-auto lg:mx-0 px-2 sm:px-0 leading-relaxed">
                        Pemberdayaan Masyarakat dalam Pengelolaan Sampah Berbasis Lingkungan Berkelanjutan di Kelurahan Tanjungmekar.
                    </p>
                    <div class="mt-8 mb-4 sm:mb-0 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start px-4 sm:px-0">
                        <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="px-8 py-3.5 text-base font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full shadow-lg hover:bg-yellow-500 hover:-translate-y-1 transition-all duration-300">Jelajahi Peta</a>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Gelombang Bawah (Tambahin relative z-10 biar posisinya di depan layar hijau transparan) -->
        <svg class="w-full text-[#F4F8F4] relative z-10" viewBox="0 0 1440 120" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </main>

    <section id="fitur" class="py-12 sm:py-16 bg-[#F4F8F4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-extrabold text-[#0E4D2B] mb-4">Layanan Digital Tanjungmekar</h3>
            <p class="text-gray-600 max-w-2xl mx-auto mb-10 sm:mb-12 leading-relaxed px-2">Fasilitas terpadu untuk mempermudah akses informasi dan fasilitas warga.</p>
            

            <div class="grid grid-cols-1 md:grid-cols-2 max-w-4xl mx-auto gap-6 sm:gap-8 px-2 sm:px-0">

                <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-t-4 border-t-[#2E7D32] group block cursor-pointer">


                    <div class="w-14 h-14 bg-[#A5D6A7] rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300 border border-[#81C784]">


                        <svg class="w-7 h-7 text-[#0E4D2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#0E4D2B] mb-2">Pemetaan Wilayah</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Cari tahu informasi letak Kantor Kelurahan, kepengurusan RW, dan Bank Sampah.</p>
                </a>
                


                <!-- KARTU BANK SAMPAH (Udah aktif link-nya) -->
                <!-- KARTU BANK SAMPAH (Arahkan ke Register jika belum login) -->
                <a href="{{ Auth::check() ? route('user.bank-sampah') : route('register') }}" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-t-4 border-t-[#FBC02D] group block cursor-pointer">

                    <div class="w-14 h-14 bg-[#FFF9E6] rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300 border border-[#FDE68A]">
                        <svg class="w-7 h-7 text-[#0E4D2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#0E4D2B] mb-2">Bank Sampah Digital</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Sistem monitoring terpadu untuk pencatatan tabungan sampah dan saldo rupiah milik warga.</p>
                </a>


            </div>

        </div>
    </section>

    <section class="py-12 sm:py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-extrabold text-[#0E4D2B] text-center mb-2">Seputar Pertanyaan (FAQ)</h3>
            <p class="text-gray-500 text-center mb-8 text-sm">Punya pertanyaan seputar portal? Berikut beberapa poin info ringkas.</p>
            
            <div class="space-y-4 mb-10 px-2 sm:px-0">
                @forelse($faqs as $faq)
                <div class="border-2 border-[#A5D6A7] rounded-lg p-5 bg-[#F4F8F4]">
                    <h5 class="font-bold text-[#0E4D2B] leading-snug">{{ $faq->pertanyaan }}</h5>
                    <p class="text-sm text-gray-600 mt-2 leading-relaxed">{{ $faq->jawaban }}</p>
                </div>
                @empty
                <div class="border-2 border-[#A5D6A7] rounded-lg p-5 bg-[#F4F8F4] text-center">
                    <p class="text-sm text-gray-500 italic">Belum ada informasi FAQ.</p>
                </div>
                @endforelse
            </div>

            <div class="text-center bg-[#F4F8F4] p-6 rounded-2xl border border-gray-200 mx-2 sm:mx-0">
                <p class="text-sm font-semibold text-gray-600 mb-3 px-2 leading-relaxed">Pertanyaan lebih lanjut atau keluhan Anda belum terjawab di atas?</p>
                <a href="{{ Auth::check() ? route('faq') : route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#0E4D2B] hover:bg-[#2E7D32] text-white text-sm font-bold rounded-full shadow transition-all group">
                    Jelajahi Semua Pertanyaan
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </section>

    @guest
    <section class="bg-[#2E7D32] py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8 text-center flex flex-col items-center">
            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">Siap Berkontribusi untuk Lingkungan?</h3>
            <p class="text-[#F4F8F4] mb-8 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">Bergabunglah bersama kami menjaga kebersihan Tanjungmekar. Daftarkan diri Anda sekarang untuk mulai memanfaatkan layanan Bank Sampah.</p>
            <a href="{{ route('register') }}" class="px-8 py-3.5 text-base sm:text-lg font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full shadow-lg hover:bg-yellow-500 hover:-translate-y-1 transition-all w-full sm:w-auto">Sign Up Sekarang</a>
        </div>
    </section>
    @endguest

    <section class="bg-[#F4F8F4] py-12 sm:py-16 border-t-2 border-gray-200">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-xs sm:text-sm font-bold text-[#2E7D32] tracking-widest uppercase mb-8">Didukung & Dikembangkan Oleh</p>
            <div class="flex flex-row justify-center items-center gap-4 sm:gap-12 md:gap-24 px-2">
                <img src="{{ asset('images/pemkab-logo.png') }}" alt="Pemkab" class="h-12 sm:h-20 md:h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform">
                <img src="{{ asset('images/logo-ubp.png') }}" alt="UBP" class="h-12 sm:h-20 md:h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform">
                <img src="{{ asset('images/logo-tema.png') }}" alt="Tema KKN" class="h-12 sm:h-20 md:h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform">
                <img src="{{ asset('images/logo-kkn.png') }}" alt="KKN Tanjungmekar" class="h-12 sm:h-20 md:h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform">
            </div>
        </div>
    </section>

    <footer class="bg-[#0E4D2B] py-8 border-t-8 border-[#2E7D32]">
        <div class="max-w-7xl mx-auto px-6 text-center flex flex-col items-center">
            <p class="text-[#F4F8F4] text-xs sm:text-sm leading-relaxed max-w-[340px] sm:max-w-none mx-auto">
                © 2026 Portal Tanjungmekar. Dikembangkan oleh Mahasiswa KKN Tanjungmekar, <span class="font-bold text-[#FBC02D]">Naufal Fauzi Rahman</span> (Sistem Informasi) - Universitas Buana Perjuangan Karawang.
            </p>
        </div>
    </footer>
</body>
</html>








resources/views/admin/dashboard.blade.php:


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | Portal Tanjungmekar</title>
    
    <!-- Favicon KKN -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-kkn.png') }}">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="{ sidebarOpen: false }">

    <!-- OVERLAY BACKGROUND MOBILE (Klik luar sidebar untuk tutup) -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" style="display: none;"></div>

    <!-- SIDEBAR - RESPONSIVE (Ngumpet di Mobile, Tampil di PC) -->
    <aside class="w-64 bg-[#0E4D2B] h-screen text-white flex flex-col shadow-xl fixed z-30 transform transition-transform duration-300 md:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <!-- HEADER SIDEBAR (DIAM/TIDAK SCROLL) -->
        <div class="h-20 flex-shrink-0 flex items-center justify-center border-b border-[#2E7D32] bg-[#0A3D22]">
            <h1 class="text-xl font-extrabold tracking-wider">PANEL ADMIN</h1>
        </div>
        
        <!-- MENU (BISA SCROLL) -->
        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-2 custom-scrollbar">


        <!-- KHUSUS TAMPIL DI HP: Link Navigasi Publik -->
            <div class="md:hidden mb-4 pb-4 border-b border-gray-300 border-opacity-30">

                <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 px-2">Navigasi</p>

                <a href="{{ url('/') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Beranda</a>
                <a href="{{ route('pemetaan') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Peta Wilayah</a>
                <a href="{{ route('user.bank-sampah') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Bank Sampah</a>
                <a href="{{ route('faq') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Pusat FAQ</a>
            </div>


            <!-- MT-0 BIAR AGAK KE ATAS -->
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-0 px-2">Menu Utama</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 bg-[#2E7D32] text-white px-4 py-3 rounded-lg font-bold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            @if(Auth::user()->role === 'admin')
            <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Halaman Operator
            </a>
            @endif
            

            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-6 px-2">Kustomisasi Web</p>
            <a href="{{ route('admin.manajemen-gambar.index') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manajemen Gambar
            </a>



            <a href="{{ route('admin.pemetaan.index') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                Manajemen Peta
            </a>
            
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-6 px-2">Data & Laporan</p>

            <a href="{{ route('admin.faq.index') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Manajemen FAQ
            </a>

            <a href="{{ route('admin.data-warga.index') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Warga
            </a>
            
            
            <a href="{{ route('admin.bank-sampah.index') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Bank Sampah
            </a>


            @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.laporan-web.index', isset($modeParam) ? $modeParam : []) }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Laporan Web
            </a>
            @endif
        </nav>
        
        <!-- FOOTER SIDEBAR -->
        <div class="p-4 border-t border-[#2E7D32] flex-shrink-0">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm text-[#A5D6A7] hover:text-white transition font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 bg-gray-50 min-h-screen w-full transition-all duration-300">
        
        <!-- HEADER KONTEN -->
        <header class="bg-white h-20 shadow-sm border-b border-gray-200 flex items-center justify-between px-4 md:px-8 z-10 sticky top-0">
            <div class="flex items-center gap-3 md:gap-6">
                <!-- TOMBOL HAMBURGER MOBILE -->
                <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg focus:outline-none transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Dashboard</h2>
                

                <nav class="hidden md:flex gap-3 lg:gap-5 text-xs lg:text-sm font-bold text-gray-500 whitespace-nowrap">

                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('user.bank-sampah') }}" class="hover:text-[#0E4D2B] transition">Bank Sampah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </nav>


            </div>
            
            <div class="flex items-center gap-3 md:gap-4">
                <!-- Warna Label Admin jadi Hijau Putih -->
                <span class="hidden sm:inline-block text-[10px] md:text-xs font-bold bg-[#0E4D2B] text-white px-2 md:px-3 py-1 rounded-full uppercase tracking-wider border border-[#0A3D22]">HAK AKSES: {{ strtoupper(Auth::user()->role) }}</span>
                <div class="hidden sm:block h-8 w-px bg-gray-300"></div>
                
                @php
                    $rawAvatar = Auth::user()->avatar;


                    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=A5D6A7&bold=true';


                    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=A5D6A7&bold=true';
                @endphp
                <div x-data="{ openAdminProfile: false }" class="relative">
                    <button @click="openAdminProfile = !openAdminProfile" class="flex items-center gap-2 px-2 md:px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-[#A5D6A7] flex items-center justify-center overflow-hidden border border-[#0E4D2B] shrink-0">

                            <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : '/storage/' . str_replace('storage/', '', Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">

                        </div>
                        <!-- Sembunyikan nama di layar HP super kecil -->
                        <span class="hidden sm:inline-block text-sm font-bold text-gray-800 whitespace-nowrap shrink-0">{{ Auth::user()->name }}</span>
                        <!-- Efek Putar Alpine JS -->
                        <svg :class="{'rotate-180': openAdminProfile}" class="w-4 h-4 text-gray-600 font-bold transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="openAdminProfile" @click.away="openAdminProfile = false" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 font-semibold">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-4 md:p-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 mb-8">
                <h3 class="text-2xl md:text-3xl font-extrabold text-[#0E4D2B] mb-2">Selamat Datang di Ruang Kendali!</h3>
                <p class="text-gray-600 text-sm md:text-base">Ini adalah *Content Management System* (CMS) khusus untuk mengatur keseluruhan Portal Tanjungmekar.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <a href="{{ route('admin.data-warga.index') }}" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Total Warga Terdaftar</h4>

                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#0E4D2B] leading-none">{{ \App\Models\User::where('role', 'user')->count() }}</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Akun Terverifikasi</span>
                    </div>
                </a>

                <a href="{{ route('admin.faq.index') }}" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Pengajuan FAQ Baru</h4>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#F59E0B] leading-none">{{ \App\Models\Faq::where('status', 'pending')->count() }}</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Menunggu Validasi</span>
                    </div>
                </a>


                <a href="{{ route('admin.bank-sampah.index') }}" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Bank Sampah Digital</h4>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#2E7D32] leading-none">{{ \App\Models\TransaksiSampah::count() }}</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Setoran Warga</span>
                    </div>
                </a>

                

               @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.laporan-web.index', isset($modeParam) ? $modeParam : []) }}" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                    <h4 class="text-xs font-bold text-gray-500 mb-4 uppercase tracking-wider">Laporan Web</h4>
                    <div class="flex items-center gap-3">
                        <h2 class="text-4xl font-black text-red-600">{{ \App\Models\LaporanWeb::count() }}</h2>
                        <p class="text-sm font-bold text-gray-500 mt-2">Kendala</p>
                    </div>
                </a>
                @endif



            </div>
        </div>
    </main>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #A5D6A7; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #2E7D32; }
    </style>
</body>
</html>








resources/views/operator/dashboard.blade.php:


@php
    $modeParam = Auth::user()->role === 'admin' ? ['mode' => 'operator'] : [];
    $rawAvatar = Auth::user()->avatar;

    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=A5D6A7&bold=true';

    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=FBC02D&bold=true';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Operator | Portal Tanjungmekar</title>
    
    <!-- Favicon KKN -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-kkn.png') }}">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" style="display: none;"></div>

    <aside class="w-64 bg-[#FBC02D] h-screen text-[#0E4D2B] flex flex-col shadow-xl fixed z-30 transform transition-transform duration-300 md:translate-x-0 border-r border-yellow-400" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-20 flex-shrink-0 flex items-center justify-center border-b border-yellow-500 bg-[#F9A825]">
            <h1 class="text-xl font-extrabold tracking-wider">PANEL OPERATOR</h1>
        </div>
        
        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-2 custom-scrollbar">


       <!-- KHUSUS TAMPIL DI HP: Link Navigasi Publik -->
            <div class="md:hidden mb-4 pb-4 border-b border-gray-300 border-opacity-30">

                <p class="text-xs font-bold text-[#0A3D22] uppercase tracking-wider mb-2 px-2">Navigasi</p>

                <a href="{{ url('/') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Beranda</a>
                <a href="{{ route('pemetaan') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Peta Wilayah</a>
                <a href="{{ route('user.bank-sampah') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Bank Sampah</a>
                <a href="{{ route('faq') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Pusat FAQ</a>
            </div>


            <p class="text-xs font-bold text-[#0A3D22] uppercase tracking-wider mb-2 mt-0 px-2">Menu Utama</p>
            
            <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-3 bg-white text-[#0E4D2B] px-4 py-3 rounded-lg font-bold transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <p class="text-xs font-bold text-[#0A3D22] uppercase tracking-wider mb-2 mt-6 px-2">Kustomisasi Web</p>
            

            <a href="{{ route('admin.manajemen-gambar.index', $modeParam) }}" class="flex items-center gap-3 hover:bg-[#F9A825] text-[#0E4D2B] hover:text-[#0A3D22] px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manajemen Gambar
            </a>
            

            <a href="{{ route('admin.pemetaan.index', $modeParam) }}" class="flex items-center gap-3 hover:bg-[#F9A825] text-[#0E4D2B] hover:text-[#0A3D22] px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                Manajemen Peta
            </a>

            <p class="text-xs font-bold text-[#0A3D22] uppercase tracking-wider mb-2 mt-6 px-2">Data & Laporan</p>

            <a href="{{ route('admin.faq.index', $modeParam) }}" class="flex items-center gap-3 hover:bg-[#F9A825] text-[#0E4D2B] hover:text-[#0A3D22] px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Manajemen FAQ
            </a>

            <a href="{{ route('admin.data-warga.index', $modeParam) }}" class="flex items-center gap-3 hover:bg-[#F9A825] text-[#0E4D2B] hover:text-[#0A3D22] px-4 py-3 rounded-lg font-semibold transition mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Warga
            </a>
            

            <a href="{{ route('admin.bank-sampah.index', $modeParam) }}" class="flex items-center gap-3 hover:bg-[#F9A825] text-[#0E4D2B] hover:text-[#0A3D22] px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Bank Sampah
            </a>


        </nav>
        
        <div class="p-4 border-t border-yellow-500 flex-shrink-0">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm text-[#0E4D2B] hover:text-[#0A3D22] transition font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 bg-gray-50 min-h-screen w-full transition-all duration-300">
        
        <header class="bg-white h-20 shadow-sm border-b border-gray-200 flex items-center justify-between px-4 md:px-8 z-10 sticky top-0">
            <div class="flex items-center gap-3 md:gap-6">
                <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg focus:outline-none transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Dashboard</h2>
                

                <nav class="hidden md:flex gap-3 lg:gap-5 text-xs lg:text-sm font-bold text-gray-500 whitespace-nowrap">

                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('user.bank-sampah') }}" class="hover:text-[#0E4D2B] transition">Bank Sampah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </nav>


            </div>
            
            <div class="flex items-center gap-3 md:gap-4">
                <!-- Warna Label Operator jadi Kuning Hijau -->
                <span class="hidden sm:inline-block text-[10px] md:text-xs font-bold bg-[#FBC02D] text-[#0E4D2B] px-2 md:px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-400">HAK AKSES: OPERATOR</span>
                <div class="hidden sm:block h-8 w-px bg-gray-300"></div>
                
                @php
                    $rawAvatar = Auth::user()->avatar;


                    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=A5D6A7&bold=true';


                    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=FBC02D&bold=true';
                @endphp
                <div x-data="{ openOperatorProfile: false }" class="relative">
                    <button @click="openOperatorProfile = !openOperatorProfile" class="flex items-center gap-2 px-2 md:px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-[#FBC02D] flex items-center justify-center overflow-hidden border border-[#0E4D2B] shrink-0">

                            <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : '/storage/' . str_replace('storage/', '', Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">

                        </div>
                        <span class="hidden sm:inline-block text-sm font-bold text-gray-800 whitespace-nowrap shrink-0">{{ Auth::user()->name }}</span>
                        <!-- Efek Putar Alpine JS -->
                        <svg :class="{'rotate-180': openOperatorProfile}" class="w-4 h-4 text-gray-600 font-bold transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="openOperatorProfile" @click.away="openOperatorProfile = false" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 font-semibold">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-4 md:p-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 mb-8">
                <h3 class="text-2xl md:text-3xl font-extrabold text-[#0E4D2B] mb-2">Selamat Datang di Ruang Kendali!</h3>
                <p class="text-gray-600 text-sm md:text-base">Ini adalah *Content Management System* (CMS) khusus untuk mengatur keseluruhan Portal Tanjungmekar.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <a href="{{ route('admin.data-warga.index', $modeParam) }}" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Total Warga Terdaftar</h4>

                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#0E4D2B] leading-none">{{ \App\Models\User::where('role', 'user')->count() }}</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Akun Terverifikasi</span>
                    </div>
                </a>

                <a href="{{ route('admin.faq.index', $modeParam) }}" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Pengajuan FAQ Baru</h4>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#F59E0B] leading-none">{{ \App\Models\Faq::where('status', 'pending')->count() }}</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Menunggu Validasi</span>
                    </div>
                </a>


                <a href="{{ route('admin.bank-sampah.index', $modeParam) }}" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Bank Sampah Digital</h4>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#2E7D32] leading-none">{{ \App\Models\TransaksiSampah::count() }}</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Setoran Warga</span>
                    </div>
                </a>


                
            </div>
        </div>
    </main>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #F9A825; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #F57F17; }
    </style>
</body>
</html>