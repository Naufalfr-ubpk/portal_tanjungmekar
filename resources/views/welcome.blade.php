<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Tanjungmekar | KKN UBP Karawang 2026</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-[#F4F8F4] text-gray-900">

    <nav x-data="{ openMobileMenu: false }" class="bg-white shadow-md border-b-4 border-[#0E4D2B] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 sm:h-24">
                
                <a href="{{ url('/') }}" class="flex items-center gap-4 group cursor-pointer">
                    <img src="{{ asset('images/logo-ubp.png') }}" alt="Logo UBP" class="h-10 sm:h-14 w-auto object-contain">
                    <div class="h-10 sm:h-12 w-px bg-gray-300"></div>
                    <img src="{{ asset('images/logo-kkn.png') }}" alt="Logo KKN" class="h-10 sm:h-14 w-auto object-contain">
                    <div class="hidden lg:block ml-3">
                        <h1 class="text-xl sm:text-2xl font-bold text-[#0E4D2B] leading-tight">Portal Tanjungmekar</h1>
                        <p class="text-xs sm:text-sm text-[#66BB6A] font-semibold tracking-wide">KKN UBP Karawang 2026</p>
                    </div>
                </a>

                <div class="hidden lg:flex items-center gap-6 text-sm font-semibold text-[#0E4D2B]">
                    <a href="{{ url('/') }}" class="hover:text-[#66BB6A] transition">Beranda</a>
                    <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="hover:text-[#66BB6A] transition">Peta Wilayah</a>
                    <a href="{{ Auth::check() ? route('faq') : route('register') }}" class="hover:text-[#66BB6A] transition">Pusat FAQ</a>
                    <a href="{{ Auth::check() ? route('laporan-web') : route('register') }}" class="hover:text-[#66BB6A] transition">Layanan</a>
                    
                    @auth
                        <div x-data="{ openProfile: false }" class="relative ml-4">
                            <button @click="openProfile = !openProfile" class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition">
                                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden border border-[#0E4D2B]">
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background=A5D6A7&bold=true';">
                                </div>
                                <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openProfile" @click.away="openProfile = false" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Profil Saya</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 font-semibold">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 ml-2">
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-[#0E4D2B] bg-transparent border-2 border-[#0E4D2B] rounded-full hover:bg-[#0E4D2B] hover:text-white transition-all">Login</a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full shadow hover:bg-yellow-500 transition-all">Sign Up</a>
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

        <div x-show="openMobileMenu" style="display: none;" class="lg:hidden bg-white border-t border-gray-200">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-bold text-[#0E4D2B] hover:bg-gray-50">Beranda</a>
                <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Peta Wilayah</a>
                <a href="{{ Auth::check() ? route('faq') : route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Pusat FAQ</a>
                <a href="{{ Auth::check() ? route('laporan-web') : route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Layanan</a>
                
                @auth
                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <div class="flex items-center gap-3 px-3 mb-3">
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-10 h-10 rounded-full border border-[#0E4D2B]" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background=A5D6A7&bold=true';">
                            <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>
                        </div>
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-700 hover:bg-gray-50">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-bold text-red-600 hover:bg-gray-50">Keluar</button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-col gap-2 mt-4 px-3">
                        <a href="{{ route('login') }}" class="text-center py-2 text-sm font-bold text-[#0E4D2B] bg-transparent border-2 border-[#0E4D2B] rounded-full">Login</a>
                        <a href="{{ route('register') }}" class="text-center py-2 text-sm font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full">Sign Up</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="relative overflow-hidden bg-[#0E4D2B]">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="pt-10 pb-12 md:pt-14 md:pb-16 lg:flex lg:items-center lg:gap-12">
                <div class="text-center lg:text-left lg:w-1/2">
                    <h2 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl leading-tight mb-6">
                        Sistem Informasi <br>
                        <span class="text-[#FBC02D]">Geografis & Bank Sampah</span>
                    </h2>
                    <p class="mt-4 text-lg text-[#F4F8F4] md:text-xl font-medium max-w-2xl mx-auto lg:mx-0">
                        Pemberdayaan Masyarakat dalam Pengelolaan Sampah Berbasis Lingkungan Berkelanjutan di Kelurahan Tanjungmekar.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="px-8 py-3.5 text-base font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full shadow-lg hover:bg-yellow-500 hover:-translate-y-1 transition-all duration-300">Jelajahi Peta</a>
                    </div>
                </div>
                <div class="mt-12 lg:mt-0 lg:w-1/2 relative">
                    <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden shadow-2xl border-4 border-[#2E7D32]">
                        <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=2070&auto=format&fit=crop" alt="Lingkungan Bersih" class="object-cover w-full h-full">
                    </div>
                </div>
            </div>
        </div>
        <svg class="w-full text-[#F4F8F4]" viewBox="0 0 1440 120" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </main>

    <section id="fitur" class="py-16 bg-[#F4F8F4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-extrabold text-[#0E4D2B] mb-4">Layanan Digital Tanjungmekar</h3>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12">Fasilitas terpadu untuk mempermudah akses informasi dan pelaporan warga.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ Auth::check() ? route('pemetaan') : route('register') }}" class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-[#2E7D32] hover:-translate-y-2 hover:shadow-xl transition-all duration-300 block">
                    <div class="w-14 h-14 bg-[#A5D6A7] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-7 h-7 text-[#0E4D2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#0E4D2B] mb-2">Pemetaan Wilayah</h4>
                    <p class="text-gray-600 text-sm">Informasi koordinat akurat Kantor Kelurahan, detail kepengurusan dari RW 01 hingga RW 15.</p>
                </a>
                
                <a href="{{ Auth::check() ? route('dashboard') : route('register') }}" class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-[#FBC02D] hover:-translate-y-2 hover:shadow-xl transition-all duration-300 block">
                    <div class="w-14 h-14 bg-[#FBC02D] bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-7 h-7 text-[#0E4D2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#0E4D2B] mb-2">Bank Sampah Digital</h4>
                    <p class="text-gray-600 text-sm">Lokasi operasional Bank Sampah beserta sistem manajemen laporan setoran tabungan warga.</p>
                </a>

                <a href="{{ Auth::check() ? route('dashboard') : route('register') }}" class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-[#66BB6A] hover:-translate-y-2 hover:shadow-xl transition-all duration-300 block">
                    <div class="w-14 h-14 bg-[#A5D6A7] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-7 h-7 text-[#0E4D2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#0E4D2B] mb-2">Aduan & Lapor Warga</h4>
                    <p class="text-gray-600 text-sm">Fasilitas pengaduan warga terkait masalah lingkungan yang terhubung langsung ke Kelurahan.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- REVISI TITLE FAQ SESUAI REQUEST -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-extrabold text-[#0E4D2B] text-center mb-2">Seputar Pertanyaan (FAQ)</h3>
            <p class="text-gray-500 text-center mb-8 text-sm">Punya pertanyaan seputar portal? Berikut beberapa poin info ringkas.</p>
            
            <div class="space-y-4 mb-10">
                <div class="border-2 border-[#A5D6A7] rounded-lg p-5 bg-[#F4F8F4]">
                    <h5 class="font-bold text-[#0E4D2B]">Bagaimana cara kerja Bank Sampah Digital?</h5>
                    <p class="text-sm text-gray-600 mt-2">Warga dapat membawa sampah non-organik dan organik ke lokasi operasional. Setiap setoran dicatat langsung sebagai saldo tabungan digital oleh operator.</p>
                </div>
                <div class="border-2 border-[#A5D6A7] rounded-lg p-5 bg-[#F4F8F4]">
                    <h5 class="font-bold text-[#0E4D2B]">Apakah warga perlu mendaftar untuk melihat Peta?</h5>
                    <p class="text-sm text-gray-600 mt-2">Iya, sistem portal ini mengharuskan warga untuk membuat akun (Sign Up) agar dapat mengakses fitur Pemetaan Wilayah, menabung di Bank Sampah, dan Lapor Warga secara aman.</p>
                </div>
                <div class="border-2 border-[#A5D6A7] rounded-lg p-5 bg-[#F4F8F4]">
                    <h5 class="font-bold text-[#0E4D2B]">Bagaimana cara melihat lokasi Bank Sampah terdekat?</h5>
                    <p class="text-sm text-gray-600 mt-2">Gunakan menu "Peta Wilayah" di atas. Peta akan menampilkan titik-titik Bank Sampah dan batas RW. Anda juga dapat menekan tombol "Temukan Lokasi Saya".</p>
                </div>
            </div>

            <div class="text-center bg-[#F4F8F4] p-6 rounded-2xl border border-gray-200">
                <p class="text-sm font-semibold text-gray-600 mb-3">Pertanyaan lebih lanjut atau keluhan Anda belum terjawab di atas?</p>
                <a href="{{ Auth::check() ? route('faq') : route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#0E4D2B] hover:bg-[#2E7D32] text-white text-sm font-bold rounded-full shadow transition-all group">
                    Jelajahi Semua Pertanyaan
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </section>

    @guest
    <section class="bg-[#2E7D32] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">
            <h3 class="text-2xl font-bold text-white mb-4">Siap Berkontribusi untuk Lingkungan?</h3>
            <p class="text-[#F4F8F4] mb-8 max-w-xl">Bergabunglah bersama kami menjaga kebersihan Tanjungmekar. Daftarkan diri Anda sekarang untuk mulai memanfaatkan layanan Bank Sampah.</p>
            <a href="{{ route('register') }}" class="px-8 py-3.5 text-lg font-bold text-[#0E4D2B] bg-[#FBC02D] rounded-full shadow-lg hover:bg-yellow-500 hover:-translate-y-1 transition-all">Sign Up Sekarang</a>
        </div>
    </section>
    @endguest

    <section class="bg-[#F4F8F4] py-16 border-t-2 border-gray-200">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm font-bold text-[#2E7D32] tracking-widest uppercase mb-8">Didukung & Dikembangkan Oleh</p>
            <div class="flex flex-col md:flex-row justify-center items-center gap-12 md:gap-24">
                <img src="{{ asset('images/logo-ubp.png') }}" alt="UBP" class="h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform">
                <img src="{{ asset('images/logo-tema.png') }}" alt="Tema KKN" class="h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform">
                <img src="{{ asset('images/logo-kkn.png') }}" alt="KKN Tanjungmekar" class="h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform">
            </div>
        </div>
    </section>

    <footer class="bg-[#0E4D2B] py-8 border-t-8 border-[#2E7D32]">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-[#F4F8F4] text-sm">
                © 2026 Portal Tanjungmekar. Dikembangkan oleh Mahasiswa KKN Tanjungmekar, <span class="font-bold text-[#FBC02D]">Naufal Fauzi Rahman</span> (Sistem Informasi) - Universitas Buana Perjuangan Karawang.
            </p>
        </div>
    </footer>
</body>
</html>