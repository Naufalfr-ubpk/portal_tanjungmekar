<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | Portal Tanjungmekar</title>
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
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 px-2">Navigasi</p>
                <a href="{{ url('/') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Beranda</a>
                <a href="{{ route('pemetaan') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Peta Wilayah</a>
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
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manajemen Gambar (UI)
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
            
            @if(Auth::user()->role === 'admin')
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition mb-4">
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
                
                <nav class="hidden md:flex gap-5 text-sm font-bold text-gray-500">
                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-3 md:gap-4">
                <span class="hidden sm:inline-block text-[10px] md:text-xs font-bold bg-[#FBC02D] text-[#0E4D2B] px-2 md:px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-400">HAK AKSES: {{ strtoupper(Auth::user()->role) }}</span>
                <div class="hidden sm:block h-8 w-px bg-gray-300"></div>
                
                @php
                    $rawAvatar = Auth::user()->avatar;
                    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset($rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=A5D6A7&bold=true';
                    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=A5D6A7&bold=true';
                @endphp
                <div x-data="{ openAdminProfile: false }" class="relative">
                    <button @click="openAdminProfile = !openAdminProfile" class="flex items-center gap-2 px-2 md:px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-[#A5D6A7] flex items-center justify-center overflow-hidden border border-[#0E4D2B]">
                            <img src="{{ $avatarUrl }}" alt="Avatar" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ $fallbackAvatar }}';">
                        </div>
                        <!-- Sembunyikan nama di layar HP super kecil -->
                        <span class="hidden sm:inline-block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-600 font-bold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
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

                <a href="#" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Pengaduan Warga <span class="text-[10px] text-red-500 ml-1">(Segera Hadir)</span></h4>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#1976D2] leading-none">0</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Laporan</span>
                    </div>
                </a>
                
                @if(Auth::user()->role === 'admin')
                <a href="#" class="block bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition transform">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Laporan Web <span class="text-[10px] text-red-500 ml-1">(Segera Hadir)</span></h4>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-[#D32F2F] leading-none">0</span>
                        <span class="text-sm font-semibold text-gray-500 mb-1">Kendala</span>
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