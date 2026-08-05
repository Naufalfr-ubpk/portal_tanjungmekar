@php
    $isOp = Auth::user()->role === 'operator' || request('mode') === 'operator';
    $modeParam = (Auth::user()->role === 'admin' && $isOp) ? ['mode' => 'operator'] : [];
    $navLink = $isOp ? 'hover:bg-[#F9A825] text-[#0E4D2B] hover:text-[#0A3D22]' : 'hover:bg-[#2E7D32] text-gray-200 hover:text-white';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Manajemen Peta | Admin Portal</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: {{ $isOp ? '#F9A825' : '#A5D6A7' }}; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: {{ $isOp ? '#F57F17' : '#2E7D32' }}; }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex w-full max-w-[100vw] overflow-x-hidden" x-data="mapManager()" x-init="initMap()">

    <!-- OVERLAY MOBILE -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" style="display: none;"></div>

    <aside class="w-64 h-screen flex flex-col shadow-xl fixed z-30 transform transition-transform duration-300 md:translate-x-0 {{ $isOp ? 'bg-[#FBC02D] text-[#0E4D2B] border-r border-yellow-400' : 'bg-[#0E4D2B] text-white' }}" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-20 flex-shrink-0 flex items-center justify-center border-b {{ $isOp ? 'bg-[#F9A825] border-yellow-500' : 'bg-[#0A3D22] border-[#2E7D32]' }}">
            <h1 class="text-xl font-extrabold tracking-wider">{{ $isOp ? 'PANEL OPERATOR' : 'PANEL ADMIN' }}</h1>
        </div>
        
        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-2 custom-scrollbar">

        <!-- KHUSUS TAMPIL DI HP: Link Navigasi Publik -->
            <div class="md:hidden mb-4 pb-4 border-b border-gray-300 border-opacity-30">

                <p class="text-xs font-bold uppercase tracking-wider mb-2 px-2 {{ $isOp ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Navigasi</p>

                <a href="{{ url('/') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Beranda</a>
                <a href="{{ route('pemetaan') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Peta Wilayah</a>
                <a href="{{ route('faq') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Pusat FAQ</a>
            </div>


            <p class="text-xs font-bold uppercase tracking-wider mb-2 mt-0 px-2 {{ $isOp ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Menu Utama</p>
            
            <a href="{{ $isOp ? route('operator.dashboard') : route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition {{ $navLink }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            @if(Auth::user()->role === 'admin' && !$isOp)
            <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Halaman Operator
            </a>
            @endif
            
            <p class="text-xs font-bold uppercase tracking-wider mb-2 mt-6 px-2 {{ $isOp ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Kustomisasi Web</p>
            <a href="{{ route('admin.manajemen-gambar.index', isset($modeParam) ? $modeParam : []) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition {{ $navLink }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manajemen Gambar
            </a>

            <a href="{{ route('admin.pemetaan.index', $modeParam) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ $isOp ? 'bg-white text-[#0E4D2B] shadow-sm' : 'bg-[#2E7D32] text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                Manajemen Peta
            </a>
            
            <p class="text-xs font-bold uppercase tracking-wider mb-2 mt-6 px-2 {{ $isOp ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Data & Laporan</p>

            <a href="{{ route('admin.faq.index', $modeParam) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition {{ $navLink }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Manajemen FAQ
            </a>

           <a href="{{ route('admin.data-warga.index', $modeParam) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition {{ $navLink }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Warga
            </a>

            <a href="{{ route('admin.bank-sampah.index', $modeParam) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition {{ $navLink }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg> 
                Bank Sampah
            </a>
            
            @if(Auth::user()->role === 'admin' && !$isOp)
            <a href="{{ route('admin.laporan-web.index', isset($modeParam) ? $modeParam : []) }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Laporan Web
            </a>
            @endif
        </nav>
        
        <div class="p-4 border-t flex-shrink-0 {{ $isOp ? 'border-yellow-500' : 'border-[#2E7D32]' }}">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm transition font-bold {{ $isOp ? 'text-[#0E4D2B] hover:text-[#0A3D22]' : 'text-[#A5D6A7] hover:text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </aside>

    <main class="flex-1 w-full min-w-0 md:ml-64 bg-gray-50 min-h-screen transition-all duration-300 overflow-x-hidden">
        <header class="bg-white h-20 shadow-sm border-b border-gray-200 flex items-center justify-between px-4 md:px-8 z-10 sticky top-0 w-full">
            <div class="flex items-center gap-3 md:gap-6">
                <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg focus:outline-none transition mr-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Manajemen Peta</h2>
                <nav class="hidden md:flex gap-5 text-sm font-bold text-gray-500">
                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-2 md:gap-4">
                @if($isOp)
                <span class="hidden sm:inline-block text-[10px] md:text-xs font-bold bg-[#0E4D2B] text-white px-2 md:px-3 py-1 rounded-full uppercase tracking-wider border border-[#0A3D22]">HAK AKSES: OPERATOR</span>
                @else
                <span class="hidden sm:inline-block text-[10px] md:text-xs font-bold bg-[#FBC02D] text-[#0E4D2B] px-2 md:px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-400">HAK AKSES: {{ strtoupper(Auth::user()->role) }}</span>
                @endif
                <div class="hidden sm:block h-8 w-px bg-gray-300"></div>
                
                @php
                    $rawAvatar = Auth::user()->avatar;
                    $bgAvatar = $isOp ? 'FBC02D' : 'A5D6A7';
                    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset($rawAvatar)) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=0E4D2B&background='.$bgAvatar.'&bold=true';
                    $fallbackAvatar = 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=0E4D2B&background='.$bgAvatar.'&bold=true';
                @endphp
                <div x-data="{ openAdminProfile: false }" class="relative">
                    <button @click="openAdminProfile = !openAdminProfile" @click.away="openAdminProfile = false" class="flex items-center gap-2 px-2 md:px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-[#{{ $bgAvatar }}] flex items-center justify-center overflow-hidden border border-[#0E4D2B]">

                            <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(str_starts_with(Auth::user()->avatar, 'storage/') ? Auth::user()->avatar : 'storage/' . Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background={{ Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7' }}&bold=true';" alt="Avatar" class="w-full h-full object-cover">

                        </div>
                        <span class="hidden sm:inline-block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="openAdminProfile ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="openAdminProfile" x-transition.opacity style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#0E4D2B] font-medium transition">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium transition">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-4 md:p-6 w-full">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-[#0E4D2B]">Daftar Titik Peta</h2>
                    <p class="text-gray-500 text-sm">Kelola data Kelurahan, Bank Sampah, dan Rukun Warga.</p>
                </div>
                <button @click="openModal('add')" class="w-full md:w-auto bg-[#0E4D2B] text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-green-800 transition flex items-center justify-center gap-2 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Lokasi Baru
                </button>
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex justify-between items-center font-bold shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 hover:text-green-900 text-2xl leading-none">&times;</button>
                </div>
            @endif

            <div class="flex overflow-x-auto hide-scroll gap-2 md:gap-3 mb-4 pb-2 w-full">
                <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-[#0E4D2B] text-white' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Semua Titik</button>
                <button @click="activeTab = 'kelurahan'" :class="activeTab === 'kelurahan' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Kantor Kelurahan</button>
                <button @click="activeTab = 'rw'" :class="activeTab === 'rw' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Rukun Warga (RW)</button>
                <button @click="activeTab = 'banksampah'" :class="activeTab === 'banksampah' ? 'bg-yellow-500 text-white border-yellow-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Bank Sampah</button>
            </div>

            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden w-full">
                <div class="overflow-x-auto w-full custom-scrollbar">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Judul / Kategori</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Pengelola / Kontak</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Koordinat & Gmaps</th>
                                <th class="px-4 md:px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Kelola</th>
                            </tr>
                        </thead>
                        <tbody x-show="activeTab === 'semua'" class="divide-y divide-gray-200">
                            @forelse($locations as $loc)
                                @include('admin.pemetaan.partials.row', ['loc' => $loc])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, belum ada titik peta yang ditambahkan secara keseluruhan.</td></tr>
                            @endforelse
                        </tbody>
                        <tbody x-show="activeTab === 'kelurahan'" style="display:none;" class="divide-y divide-gray-200">
                            @forelse($locations->where('type', 'kelurahan') as $loc)
                                @include('admin.pemetaan.partials.row', ['loc' => $loc])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, belum ada data titik peta untuk Kantor Kelurahan.</td></tr>
                            @endforelse
                        </tbody>
                        <tbody x-show="activeTab === 'rw'" style="display:none;" class="divide-y divide-gray-200">
                            @forelse($locations->where('type', 'rw') as $loc)
                                @include('admin.pemetaan.partials.row', ['loc' => $loc])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, belum ada data titik peta untuk Rukun Warga (RW).</td></tr>
                            @endforelse
                        </tbody>
                        <tbody x-show="activeTab === 'banksampah'" style="display:none;" class="divide-y divide-gray-200">
                            @forelse($locations->where('type', 'banksampah') as $loc)
                                @include('admin.pemetaan.partials.row', ['loc' => $loc])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, belum ada data titik peta untuk Bank Sampah.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL FORM UTAMA -->
            <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-[100] bg-black bg-opacity-70 flex items-center justify-center p-4 md:p-6 overflow-hidden">
                
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl flex flex-col md:flex-row overflow-hidden relative h-[90vh] md:h-[85vh] mx-auto">
                    
                    <!-- AREA MAP -->
                    <div class="w-full md:w-1/2 h-[35vh] md:h-full relative bg-gray-100 flex-shrink-0">
                        <div class="absolute top-3 right-3 md:top-4 md:right-4 z-[400] bg-white px-2 py-1 sm:px-3 sm:py-1.5 rounded shadow text-[10px] sm:text-xs font-bold text-[#0E4D2B] flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                            <span class="hidden sm:inline">Geser Jarum / Klik Peta untuk Set Koordinat</span>
                            <span class="sm:hidden">Set Koordinat</span>
                        </div>
                        <div class="absolute bottom-4 left-4 z-[400] flex flex-col gap-2">
                            <button @click="resetMap()" type="button" class="bg-white p-2 rounded shadow hover:bg-gray-100" title="Reset Posisi">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </button>
                            <button @click="getMyLocation()" type="button" class="bg-white p-2 rounded shadow hover:bg-gray-100" title="Lokasi Saya">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <div id="adminMap" class="w-full h-full z-10"></div>
                    </div>

                    <!-- AREA FORM -->
                    <div class="w-full md:w-1/2 flex flex-col flex-1 min-h-0 bg-white overflow-hidden">
                        
                        <!-- STICKY HEADER -->
                        <div class="flex justify-between items-center p-4 border-b border-gray-200 bg-white flex-shrink-0 z-20 shadow-sm">
                            <h3 class="text-lg md:text-xl font-bold text-[#0E4D2B]" x-text="modalTitle"></h3>
                            <button @click="closeModal()" type="button" class="text-gray-400 hover:text-red-600 bg-gray-100 hover:bg-red-50 p-1.5 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <!-- SCROLLABLE BODY -->
                        <div class="p-4 md:p-6 overflow-y-auto custom-scrollbar flex-1 w-full overflow-x-hidden">
                            <form :action="formAction" method="POST">
                                @csrf
                                <input type="hidden" name="_method" :value="formMethod">
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                                        <select name="type" x-model="formData.type" @change="autoSetLabels()" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]" required>
                                            <option value="" disabled>-- Pilih Kategori --</option>
                                            <option value="kelurahan">Kantor Kelurahan</option>
                                            <option value="rw">Rukun Warga (RW)</option>
                                            <option value="banksampah">Bank Sampah</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1">Judul Tempat</label>
                                        <input type="text" name="title" x-model="formData.title" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]" required placeholder="Cth: Bank Sampah RW 04">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Label Pengelola</label>
                                        <input type="text" name="manager_label" x-model="formData.manager_label" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Cth: Ketua RW" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                                        <input type="text" name="manager_name" x-model="formData.manager_name" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Cth: Bapak Ahmad / Ibu Siti" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Label Kontak</label>
                                        <input type="text" name="contact_label" x-model="formData.contact_label" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Cth: Kontak / Resepsionis" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">No. Handphone</label>
                                        <input type="text" name="contact_number" x-model="formData.contact_number" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Cth: 0812-XXXX-XXXX">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Koordinat <span class="text-[10px] font-normal text-gray-500">(Latitude, Longitude)</span></label>
                                    <input type="text" id="koordinatInput" name="koordinat" x-model="formData.koordinat" @input="updateMarkerFromInput" class="w-full rounded-md border-gray-300 shadow-sm text-sm bg-blue-50 focus:bg-white font-mono" placeholder="Cth: -6.294132, 107.295258" required>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1">Link Google Maps (Opsional)</label>
                                        <input type="text" name="gmaps_link" x-model="formData.gmaps_link" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Cth: https://maps.app.goo.gl/...">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1">Teks Tombol Link</label>
                                        <input type="text" name="gmaps_button_text" x-model="formData.gmaps_button_text" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Cth: Buka di Google Maps">
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Lengkap <span class="text-[10px] font-normal text-gray-500">(Bisa diedit manual)</span></label>
                                    <textarea name="address" id="alamatInput" x-model="formData.address" rows="2" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]" placeholder="Cth: Dusun Krajan, RT 01 / RW 02..." required></textarea>
                                </div>

                                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-4 pt-4 border-t border-gray-200 pb-2">
                                    <button type="button" @click="closeModal()" class="w-full sm:w-auto px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg shadow hover:bg-green-800 transition">Simpan Lokasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL KONFIRMASI HAPUS CUSTOM -->
            <div x-show="deleteModalOpen" style="display: none;" class="fixed inset-0 z-[120] bg-black bg-opacity-70 flex items-center justify-center p-4 overflow-hidden">
                <div @click.away="closeDeleteModal()" class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md text-center transform transition-all mx-auto">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Yakin Ingin Menghapus?</h3>
                    <p class="text-sm text-gray-500 mb-6">Data lokasi ini akan dihapus secara permanen dari peta dan sistem. Anda tidak bisa mengembalikannya.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-3">
                        <button @click="closeDeleteModal()" class="w-full sm:w-auto px-6 py-2.5 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <form :action="deleteUrl" method="POST" class="w-full sm:w-auto inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full px-6 py-2.5 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition shadow-md">Ya, Hapus Titik!</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    
    <script>
    function mapManager() {
        return {
            sidebarOpen: false,
            activeTab: 'semua',
            isModalOpen: false,
            modalTitle: 'Tambah Lokasi Baru',
            formAction: '{{ route('admin.pemetaan.store') }}',
            formMethod: 'POST',
            map: null,
            marker: null,
            defaultLat: -6.273213,
            defaultLng: 107.273665,
            
            formData: {
                type: '', title: '', manager_label: '', manager_name: '', 
                contact_label: '', contact_number: '', koordinat: '', 
                gmaps_link: '', gmaps_button_text: '', address: ''
            },
            
            deleteModalOpen: false,
            deleteUrl: '',

            openDeleteModal(url) {
                this.deleteUrl = url;
                this.deleteModalOpen = true;
            },

            closeDeleteModal() {
                this.deleteModalOpen = false;
                this.deleteUrl = '';
            },

            autoSetLabels() {
                if(this.formData.type === 'kelurahan') { 
                    this.formData.manager_label = 'Lurah'; 
                    this.formData.contact_label = 'Resepsionis'; 
                } else if(this.formData.type === 'banksampah') { 
                    this.formData.manager_label = 'Pengelola'; 
                    this.formData.contact_label = 'Kontak'; 
                } else if(this.formData.type === 'rw') { 
                    this.formData.manager_label = 'Ketua RW'; 
                    this.formData.contact_label = 'Kontak'; 
                }
            },

            openModal(mode, data = null) {
                this.isModalOpen = true;
                if(mode === 'edit') {
                    this.modalTitle = 'Edit Data Lokasi';
                    this.formAction = `/admin/pemetaan/${data.id}`;
                    this.formMethod = 'PUT';
                    this.formData = { ...data };
                } else {
                    this.modalTitle = 'Tambah Lokasi Baru';
                    this.formAction = '{{ route('admin.pemetaan.store') }}';
                    this.formMethod = 'POST';
                    this.formData = {
                        type: '', title: '', manager_label: '', manager_name: '', 
                        contact_label: '', contact_number: '', koordinat: '', 
                        gmaps_link: '', gmaps_button_text: '', address: ''
                    };
                }
                
                setTimeout(() => { 
                    if(this.map) {
                        this.map.invalidateSize(); 
                        this.setMapMarkerFromData();
                    }
                }, 300);
            },
            
            closeModal() {
                this.isModalOpen = false;
            },

            initMap() {
                this.map = L.map('adminMap', { zoomControl: true }).setView([this.defaultLat, this.defaultLng], 14);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap | KKN UBP Karawang 2026'
                }).addTo(this.map);

                this.marker = L.marker([this.defaultLat, this.defaultLng], {draggable: true}).addTo(this.map);

                this.map.on('click', (e) => {
                    this.updateLocation(e.latlng.lat, e.latlng.lng);
                });

                this.marker.on('dragend', (e) => {
                    let position = this.marker.getLatLng();
                    this.updateLocation(position.lat, position.lng);
                });
            },

            updateLocation(lat, lng) {
                this.marker.setLatLng([lat, lng]);
                this.formData.koordinat = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        if(data && data.display_name) {
                            this.formData.address = data.display_name;
                        }
                    });
            },

            updateMarkerFromInput() {
                if(!this.formData.koordinat) return;
                let val = this.formData.koordinat.split(',');
                if(val.length === 2) {
                    let lat = parseFloat(val[0].trim());
                    let lng = parseFloat(val[1].trim());
                    if(!isNaN(lat) && !isNaN(lng)) {
                        this.marker.setLatLng([lat, lng]);
                        this.map.flyTo([lat, lng], 17);
                    }
                }
            },

            setMapMarkerFromData() {
                if(this.formData.koordinat) {
                    let val = this.formData.koordinat.split(',');
                    if(val.length === 2) {
                        let lat = parseFloat(val[0].trim());
                        let lng = parseFloat(val[1].trim());
                        this.marker.setLatLng([lat, lng]);
                        this.map.setView([lat, lng], 17);
                        return;
                    }
                }
                this.marker.setLatLng([this.defaultLat, this.defaultLng]);
                this.map.setView([this.defaultLat, this.defaultLng], 14);
            },

            resetMap() {
                this.setMapMarkerFromData();
            },

            getMyLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        this.updateLocation(position.coords.latitude, position.coords.longitude);
                        this.map.flyTo([position.coords.latitude, position.coords.longitude], 17);
                    }, () => {
                        alert('Gagal mendeteksi lokasi. Pastikan GPS aktif/diizinkan.');
                    });
                } else {
                    alert('Browser tidak mendukung deteksi lokasi.');
                }
            }
        }
    }
    </script>
</body>
</html>