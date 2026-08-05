@php
    $realRole = Auth::user()->role;
    $mode = request()->query('mode');
    $isSimulatingOperator = ($realRole === 'admin' && $mode === 'operator');
    $isAdminTheme = ($realRole === 'admin' && !$isSimulatingOperator);
    $modeParam = $isSimulatingOperator ? ['mode' => 'operator'] : [];
    
    // Tema Sidebar
    $bgSidebar = $isAdminTheme ? 'bg-[#0E4D2B]' : 'bg-[#FBC02D]';
    $textSidebar = $isAdminTheme ? 'text-white' : 'text-[#0E4D2B]';
    $borderSidebar = $isAdminTheme ? 'border-[#2E7D32]' : 'border-yellow-400';
    $headerSidebar = $isAdminTheme ? 'bg-[#0A3D22]' : 'bg-[#F9A825]';
    $titleSidebar = $isAdminTheme ? 'PANEL ADMIN' : 'PANEL OPERATOR';
    $menuTitle = $isAdminTheme ? 'text-[#A5D6A7]' : 'text-[#0A3D22]';
    $hoverBg = $isAdminTheme ? 'hover:bg-[#2E7D32]' : 'hover:bg-[#F9A825]';
    $hoverText = $isAdminTheme ? 'hover:text-white' : 'hover:text-[#0A3D22]';
    $activeBg = $isAdminTheme ? 'bg-[#2E7D32]' : 'bg-white';
    $activeText = $isAdminTheme ? 'text-white' : 'text-[#0E4D2B]';
    $displayRole = $isSimulatingOperator ? 'operator' : $realRole;
    
    // LOGIKA AVATAR BERSIH
    $rawAvatar = Auth::user()->avatar;
    $avatarBgColor = $isAdminTheme ? 'A5D6A7' : 'FBC02D';
    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . $avatarBgColor . '&bold=true';
    
    if ($rawAvatar) {
        $avatarUrl = str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar);
    } else {
        $avatarUrl = $fallbackAvatar;
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Web | Portal Tanjungmekar</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: {{ $isAdminTheme ? '#A5D6A7' : '#F9A825' }}; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: {{ $isAdminTheme ? '#2E7D32' : '#F57F17' }}; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="laporanWebManager()">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" style="display: none;"></div>

    <aside class="w-64 {{ $bgSidebar }} h-screen {{ $textSidebar }} flex flex-col shadow-xl fixed z-30 transform transition-transform duration-300 md:translate-x-0 {{ $isAdminTheme ? '' : $borderSidebar }}" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-20 flex-shrink-0 flex items-center justify-center border-b {{ $borderSidebar }} {{ $headerSidebar }}">
            <h1 class="text-xl font-extrabold tracking-wider">{{ $titleSidebar }}</h1>
        </div>
        
        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-2 custom-scrollbar">
            <p class="text-xs font-bold {{ $menuTitle }} uppercase tracking-wider mb-2 mt-0 px-2">Menu Utama</p>
            <a href="{{ $isAdminTheme ? route('admin.dashboard') : route('operator.dashboard') }}" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <p class="text-xs font-bold {{ $menuTitle }} uppercase tracking-wider mb-2 mt-6 px-2">Kustomisasi Web</p>
            <a href="{{ route('admin.manajemen-gambar.index', $modeParam) }}" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manajemen Gambar
            </a>
            <a href="{{ route('admin.pemetaan.index', $modeParam) }}" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                Manajemen Peta
            </a>

            <p class="text-xs font-bold {{ $menuTitle }} uppercase tracking-wider mb-2 mt-6 px-2">Data & Laporan</p>
            <a href="{{ route('admin.faq.index', $modeParam) }}" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Manajemen FAQ
            </a>
            <a href="{{ route('admin.data-warga.index', $modeParam) }}" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Warga
            </a>
            <a href="{{ route('admin.bank-sampah.index', $modeParam) }}" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Bank Sampah
            </a>

            <a id="active-menu-item" href="{{ route('admin.laporan-web.index', $modeParam) }}" class="flex items-center gap-3 {{ $activeBg }} {{ $activeText }} px-4 py-3 rounded-lg font-bold transition mb-4 {{ $isAdminTheme ? '' : 'shadow-sm' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Laporan Web
            </a>
        </nav>
        
        <div class="p-4 border-t {{ $borderSidebar }} flex-shrink-0">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm {{ $menuTitle }} {{ $hoverText }} transition font-bold">
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
                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Laporan Web</h2>
                <div class="hidden md:flex items-center gap-6 text-sm font-bold text-gray-500">
                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </div>
            </div>
            
            <div class="flex items-center gap-3 md:gap-4">
                <span class="hidden sm:inline-block text-[10px] md:text-xs font-bold {{ $isAdminTheme ? 'bg-[#0E4D2B] text-white border-[#0A3D22]' : 'bg-[#FBC02D] text-[#0E4D2B] border-yellow-400' }} px-2 md:px-3 py-1 rounded-full uppercase tracking-wider border">HAK AKSES: {{ strtoupper($displayRole) }}</span>
                <div class="hidden sm:block h-8 w-px bg-gray-300"></div>
                <div x-data="{ openProfile: false }" class="relative">
                    <button @click="openProfile = !openProfile" class="flex items-center gap-2 px-2 md:px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-8 h-8 rounded-full {{ $isAdminTheme ? 'bg-[#A5D6A7]' : 'bg-[#FBC02D]' }} flex items-center justify-center overflow-hidden border border-[#0E4D2B]">
                            <img src="{{ $avatarUrl }}" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="hidden sm:inline-block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    </button>
                    <div x-show="openProfile" @click.away="openProfile = false" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-50">
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
            <div class="mb-6">
                <h3 class="text-xl md:text-2xl font-extrabold text-[#0E4D2B]">Manajemen Laporan Web</h3>
                <p class="text-sm text-gray-500 mt-1">Pantau dan kelola kendala sistem yang dilaporkan oleh pengguna.</p>
            </div>

            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex justify-between items-center font-bold shadow-sm">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-green-700 hover:text-green-900 text-2xl leading-none">&times;</button>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($laporans as $laporan)
                <div x-data="{ modalOpen: false }" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-red-100 text-red-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $laporan->jenis_kendala }}</span>
                            <span class="text-xs text-gray-400 font-semibold">{{ $laporan->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">{{ $laporan->user->name ?? 'Pengguna' }}</h4>
                        <p class="text-xs text-gray-500 mb-3">{{ $laporan->user->email ?? '-' }}</p>
                        <p class="text-sm text-gray-600 line-clamp-3 mb-4">{{ $laporan->deskripsi }}</p>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <button @click="modalOpen = true" class="w-full bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold py-2 rounded-lg text-sm border border-gray-200 transition">Baca Selengkapnya</button>
                        <div class="flex gap-2">
                            <!-- Validasi Ijo -->
                            <form action="{{ route('admin.laporan-web.resolve', $laporan->id) }}" method="POST" class="w-1/2">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Tandai kendala ini telah diperbaiki?')" class="w-full flex justify-center items-center gap-1 bg-[#e8f5e9] hover:bg-green-100 text-[#2E7D32] border border-[#A5D6A7] font-bold py-2 rounded-lg text-xs transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Diperbaiki
                                </button>
                            </form>
                            <!-- Validasi Merah -->
                            <form action="{{ route('admin.laporan-web.destroy', $laporan->id) }}" method="POST" class="w-1/2">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus laporan ini permanen?')" class="w-full flex justify-center items-center gap-1 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-bold py-2 rounded-lg text-xs transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Detail Laporan -->
                    <div x-show="modalOpen" x-transition.opacity @click.self="modalOpen = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" style="display: none;">
                        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
                            <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                                <h3 class="font-extrabold text-gray-900 text-lg">Detail Laporan</h3>
                                <button @click="modalOpen = false" class="text-gray-400 hover:text-red-500 transition focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            <div class="p-6 overflow-y-auto">
                                <div class="mb-4">
                                    <span class="text-xs font-bold text-gray-400 uppercase">Pelapor</span>
                                    <p class="font-semibold text-gray-800">{{ $laporan->user->name ?? 'Pengguna' }} ({{ $laporan->user->email ?? '-' }})</p>
                                </div>
                                <div class="mb-4">
                                    <span class="text-xs font-bold text-gray-400 uppercase">Jenis Kendala</span>
                                    <p class="font-semibold text-red-600 mt-1">{{ $laporan->jenis_kendala }}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase">Deskripsi Error</span>
                                    <div class="mt-2 p-4 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 whitespace-pre-wrap">{{ $laporan->deskripsi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="w-20 h-20 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-2">Semua Aman!</h3>
                    <p class="text-gray-500">Tidak ada pengaduan laporan web dari warga saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    <script>
        function laporanWebManager() {
            return {
                sidebarOpen: false,
                init() {
                    this.$nextTick(() => {
                        const activeMenu = document.getElementById('active-menu-item');
                        if(activeMenu) {
                            activeMenu.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                }
            }
        }
    </script>
</body>
</html>