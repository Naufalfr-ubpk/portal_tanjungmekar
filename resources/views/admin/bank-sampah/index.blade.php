@php
    $realRole = Auth::user()->role;
    $mode = request()->query('mode');
    $isSimulatingOperator = ($realRole === 'admin' && $mode === 'operator');
    $isAdminTheme = ($realRole === 'admin' && !$isSimulatingOperator);
    $modeParam = $isSimulatingOperator ? ['mode' => 'operator'] : [];

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
    
    $rawAvatar = Auth::user()->avatar;
    $avatarColor = '0E4D2B';
    $avatarBgColor = $isAdminTheme ? 'A5D6A7' : 'FBC02D';
    $avatarUrl = ($rawAvatar && str_starts_with($rawAvatar, 'http')) ? $rawAvatar : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . "&color=$avatarColor&background=$avatarBgColor&bold=true";
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bank Sampah | Portal Tanjungmekar</title>
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
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="bankSampahManager()">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" style="display: none;"></div>

    <!-- Tambahan id="sidebar-container" untuk fitur scroll -->
    <aside class="w-64 {{ $bgSidebar }} h-screen {{ $textSidebar }} flex flex-col shadow-xl fixed z-30 transform transition-transform duration-300 md:translate-x-0 {{ $isAdminTheme ? '' : $borderSidebar }}" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-20 flex-shrink-0 flex items-center justify-center border-b {{ $borderSidebar }} {{ $headerSidebar }}">
            <h1 class="text-xl font-extrabold tracking-wider">{{ $titleSidebar }}</h1>
        </div>
        
        <nav id="sidebar-container" class="flex-1 overflow-y-auto px-4 py-4 space-y-2 custom-scrollbar">
            <div class="md:hidden mb-4 pb-4 border-b border-gray-300 border-opacity-30">
                <p class="text-xs font-bold uppercase tracking-wider mb-2 px-2 {{ $isSimulatingOperator ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Navigasi</p>
                <a href="{{ url('/') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Beranda</a>
                <a href="{{ route('pemetaan') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Peta Wilayah</a>
                <a href="{{ route('faq') }}" class="block px-4 py-2 text-sm font-semibold hover:bg-black hover:bg-opacity-10 rounded-lg transition">Pusat FAQ</a>
            </div>

            <p class="text-xs font-bold {{ $menuTitle }} uppercase tracking-wider mb-2 mt-0 px-2">Menu Utama</p>
            <a href="{{ $isAdminTheme ? route('admin.dashboard') : route('operator.dashboard') }}" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            @if($isAdminTheme)
            <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Halaman Operator
            </a>
            @endif
            
            <p class="text-xs font-bold {{ $menuTitle }} uppercase tracking-wider mb-2 mt-6 px-2">Kustomisasi Web</p>
            <a href="#" class="flex items-center gap-3 {{ $hoverBg }} {{ $isAdminTheme ? 'text-gray-200' : 'text-[#0E4D2B]' }} {{ $hoverText }} px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manajemen Gambar (UI)
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

            <!-- ID khusus untuk mendeteksi item yang aktif buat scroll otomatis -->
            <a id="active-menu-item" href="{{ route('admin.bank-sampah.index', $modeParam) }}" class="flex items-center gap-3 {{ $activeBg }} {{ $activeText }} px-4 py-3 rounded-lg font-bold transition {{ $isAdminTheme ? '' : 'shadow-sm' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Bank Sampah
            </a>
            
            @if($isAdminTheme)
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Laporan Web
            </a>
            @endif
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
                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Bank Sampah</h2>
                
                <nav class="hidden md:flex gap-5 text-sm font-bold text-gray-500">
                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-3 md:gap-4">
                <span class="hidden sm:inline-block text-[10px] md:text-xs font-bold {{ $isAdminTheme ? 'bg-[#0E4D2B] text-white border-[#0A3D22]' : 'bg-[#FBC02D] text-[#0E4D2B] border-yellow-400' }} px-2 md:px-3 py-1 rounded-full uppercase tracking-wider border">HAK AKSES: {{ strtoupper($displayRole) }}</span>
                <div class="hidden sm:block h-8 w-px bg-gray-300"></div>
                
                <div x-data="{ openProfile: false }" class="relative">
                    <button @click="openProfile = !openProfile" class="flex items-center gap-2 px-2 md:px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-8 h-8 rounded-full {{ $isAdminTheme ? 'bg-[#A5D6A7]' : 'bg-[#FBC02D]' }} flex items-center justify-center overflow-hidden border border-[#0E4D2B]">
                            <img src="{{ $avatarUrl }}" alt="Avatar" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background=A5D6A7&bold=true';">
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
            <!-- Alert Notifikasi -->
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex justify-between items-center font-bold shadow-sm">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-green-700 hover:text-green-900 text-2xl leading-none">&times;</button>
            </div>
            @endif

            @if(session('error'))
            <div x-data="{ show: true }" x-show="show" class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg mb-6 flex justify-between items-center font-bold shadow-sm">
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="text-red-700 hover:text-red-900 text-2xl leading-none">&times;</button>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-[#0E4D2B]">Manajemen Bank Sampah</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola data kategori sampah dan riwayat setoran tabungan warga.</p>
                    </div>
                    
                    <button x-show="activeTab === 'kategori'" @click="isKategoriOpen = true" class="w-full md:w-auto bg-[#F59E0B] text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-yellow-600 transition flex items-center justify-center gap-2 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Kategori
                    </button>
                    <button x-show="activeTab === 'transaksi'" style="display: none;" @click="isTransaksiOpen = true" class="w-full md:w-auto bg-[#0E4D2B] text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-green-800 transition flex items-center justify-center gap-2 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Setoran
                    </button>
                </div>

                <!-- TABS MEMORI -->
                <div class="px-6 pt-4 flex gap-6 border-b border-gray-200 text-sm font-semibold">
                    <button @click="activeTab = 'kategori'" :class="activeTab === 'kategori' ? 'border-[#0E4D2B] text-[#0E4D2B]' : 'border-transparent text-gray-500 hover:text-gray-700'" class="pb-3 border-b-2 transition">Kategori & Harga Sampah</button>
                    <button @click="activeTab = 'transaksi'" :class="activeTab === 'transaksi' ? 'border-[#0E4D2B] text-[#0E4D2B]' : 'border-transparent text-gray-500 hover:text-gray-700'" class="pb-3 border-b-2 transition">Riwayat Transaksi</button>
                </div>

                <!-- TABEL KATEGORI -->
                <div x-show="activeTab === 'kategori'" class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-200">
                                <th class="px-6 py-4 font-bold">Kategori Sampah</th>
                                <th class="px-6 py-4 font-bold">Harga per Satuan</th>
                                <th class="px-6 py-4 font-bold text-center uppercase">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($kategori as $k)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $k->nama_kategori }}</td>
                                    <td class="px-6 py-4 font-bold text-green-600">Rp {{ number_format($k->harga_per_satuan, 0, ',', '.') }} <span class="text-gray-500 text-xs font-normal">/ {{ $k->satuan }}</span></td>
                                    <td class="px-6 py-4 flex items-center justify-center gap-2">
                                        <button @click="openEditKategori({{ json_encode($k) }})" class="bg-yellow-400 hover:bg-yellow-500 text-white p-1.5 rounded-lg transition shadow-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        <button @click="openDeleteModal('{{ route('admin.bank-sampah.kategori.destroy', $k->id) }}')" class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-lg transition shadow-sm" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        <p class="font-semibold text-lg">Belum ada master kategori sampah.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- TABEL TRANSAKSI -->
                <div x-show="activeTab === 'transaksi'" style="display: none;" class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-200">
                                <th class="px-6 py-4 font-bold">Tanggal</th>
                                <th class="px-6 py-4 font-bold">Nama Warga</th>
                                <th class="px-6 py-4 font-bold">Jenis Sampah</th>
                                <th class="px-6 py-4 font-bold">Berat / Qty</th>
                                <th class="px-6 py-4 font-bold">Total Rupiah</th>
                                <th class="px-6 py-4 font-bold text-center">Status</th>
                                <th class="px-6 py-4 font-bold text-center uppercase">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($transaksi as $t)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($t->tanggal_setor)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $t->user?->name ?? 'User Dihapus' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $t->kategoriSampah?->nama_kategori ?? 'Tidak Diketahui' }}</td>
                                    
                                    <!-- FORMAT QTY BERSIH: 3.00 1Kg jadi 3 Kg -->
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                                        {{ floatval($t->berat_jumlah) }} {{ trim(preg_replace('/[0-9]+/', '', $t->kategoriSampah?->satuan ?? '')) }}
                                    </td>
                                    
                                    <td class="px-6 py-4 font-bold text-green-600">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-green-100 text-green-800 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Selesai</span>
                                    </td>
                                    <td class="px-6 py-4 flex items-center justify-center gap-2">
                                        <button @click="openEditTransaksi({{ json_encode($t) }})" class="bg-yellow-400 hover:bg-yellow-500 text-white p-1.5 rounded-lg transition shadow-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        <button @click="openDeleteModal('{{ route('admin.bank-sampah.transaksi.destroy', $t->id) }}')" class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-lg transition shadow-sm" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        <p class="font-semibold text-lg">Belum ada transaksi setoran sampah.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- MODAL TAMBAH KATEGORI (Terkunci) -->
        <div x-show="isKategoriOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden relative">
                <button @click="isKategoriOpen = false" class="absolute top-4 right-4 text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <div class="bg-[#F59E0B] p-5 text-white flex justify-between items-center">
                    <h3 class="text-xl font-bold">Tambah Kategori Sampah</h3>
                </div>
                <form action="{{ route('admin.bank-sampah.kategori.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kategori" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#F59E0B] focus:ring-[#F59E0B]" placeholder="Cth: Botol Plastik / Kardus Bekas">
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Satuan <span class="text-red-500">*</span></label>
                            <input type="text" name="satuan" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#F59E0B] focus:ring-[#F59E0B]" placeholder="Cth: Kg, Liter, Pcs">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="harga_per_satuan" required min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#F59E0B] focus:ring-[#F59E0B]" placeholder="Cth: 2500">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button type="button" @click="isKategoriOpen = false" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-[#F59E0B] text-white font-bold rounded-lg shadow hover:bg-yellow-600 transition">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT KATEGORI (Terkunci) -->
        <div x-show="isEditKategoriOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden relative">
                <button @click="isEditKategoriOpen = false" class="absolute top-4 right-4 text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <div class="bg-blue-600 p-5 text-white flex justify-between items-center">
                    <h3 class="text-xl font-bold">Edit Kategori Sampah</h3>
                </div>
                <form :action="editKategoriAction" method="POST" class="p-6">
                    @csrf @method('PUT')
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" x-model="editKategoriData.nama_kategori" name="nama_kategori" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Satuan <span class="text-red-500">*</span></label>
                            <input type="text" x-model="editKategoriData.satuan" name="satuan" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" x-model="editKategoriData.harga_per_satuan" name="harga_per_satuan" required min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button type="button" @click="isEditKategoriOpen = false" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL TAMBAH SETORAN (TRANSAKSI) (Terkunci) -->
        <div x-show="isTransaksiOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden relative">
                <button @click="isTransaksiOpen = false" class="absolute top-4 right-4 text-white hover:text-gray-300 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <div class="bg-[#0E4D2B] p-5 text-white flex justify-between items-center">
                    <h3 class="text-xl font-bold">Catat Setoran Warga</h3>
                </div>
                <form action="{{ route('admin.bank-sampah.transaksi.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Setor <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_setor" x-model="todayDate" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring-[#0E4D2B]">
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Warga <span class="text-red-500">*</span></label>
                        <select name="user_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring-[#0E4D2B]">
                            <option value="" disabled selected>-- Pilih Akun Warga --</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->id }}">{{ $w->name }} ({{ $w->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Sampah <span class="text-red-500">*</span></label>
                            <select name="kategori_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring-[#0E4D2B]">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }} (Rp {{ number_format($k->harga_per_satuan, 0, ',', '.') }}/{{ $k->satuan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Berat / Jumlah <span class="text-red-500">*</span></label>
                            <input type="number" step="0.1" min="0.1" name="berat_jumlah" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring-[#0E4D2B]" placeholder="Cth: 2.5">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button type="button" @click="isTransaksiOpen = false" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg shadow hover:bg-green-800 transition">Simpan Setoran</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT SETORAN (TRANSAKSI) (Terkunci) -->
        <div x-show="isEditTransaksiOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden relative">
                <button @click="isEditTransaksiOpen = false" class="absolute top-4 right-4 text-white hover:text-gray-300 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <div class="bg-blue-600 p-5 text-white flex justify-between items-center">
                    <h3 class="text-xl font-bold">Edit Setoran Warga</h3>
                </div>
                <form :action="editTransaksiAction" method="POST" class="p-6">
                    @csrf @method('PUT')
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Setor <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_setor" x-model="editTransaksiData.tanggal_setor" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Warga <span class="text-red-500">*</span></label>
                        <select name="user_id" x-model="editTransaksiData.user_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                            @foreach($warga as $w)
                                <option value="{{ $w->id }}">{{ $w->name }} ({{ $w->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Sampah <span class="text-red-500">*</span></label>
                            <select name="kategori_id" x-model="editTransaksiData.kategori_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }} (Rp {{ number_format($k->harga_per_satuan, 0, ',', '.') }}/{{ $k->satuan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Berat / Jumlah <span class="text-red-500">*</span></label>
                            <input type="number" step="0.1" min="0.1" name="berat_jumlah" x-model="editTransaksiData.berat_jumlah" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button type="button" @click="isEditTransaksiOpen = false" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL KONFIRMASI HAPUS (Terkunci) -->
        <div x-show="deleteModalOpen" style="display: none;" class="fixed inset-0 z-[120] flex items-center justify-center bg-black bg-opacity-70 p-4">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md text-center relative">
                <button @click="closeDeleteModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Yakin Ingin Menghapus?</h3>
                <p class="text-sm text-gray-500 mb-6">Data ini akan dihapus secara permanen dari sistem. Apakah Anda yakin ingin menghapusnya?</p>
                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    <button @click="closeDeleteModal()" class="w-full sm:w-auto px-6 py-2.5 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                    <form :action="deleteUrl" method="POST" class="w-full sm:w-auto inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full px-6 py-2.5 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition shadow-md">Ya, Hapus!</button>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <script>
        function bankSampahManager() {
            return {
                sidebarOpen: false,
                activeTab: '{{ session('active_tab', 'kategori') }}', // Memori Tab dari Controller
                
                isKategoriOpen: false,
                isTransaksiOpen: false,
                
                isEditKategoriOpen: false,
                editKategoriAction: '',
                editKategoriData: { nama_kategori: '', satuan: '', harga_per_satuan: '' },
                
                isEditTransaksiOpen: false,
                editTransaksiAction: '',
                editTransaksiData: { user_id: '', kategori_id: '', berat_jumlah: '', tanggal_setor: '' },

                deleteModalOpen: false,
                deleteUrl: '',
                todayDate: new Date().toISOString().split('T')[0],

                init() {
                    // Scroll otomatis sidebar ke menu yang aktif
                    this.$nextTick(() => {
                        const activeMenu = document.getElementById('active-menu-item');
                        if(activeMenu) {
                            activeMenu.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                },

                openEditKategori(kategori) {
                    this.editKategoriData = { ...kategori };
                    this.editKategoriAction = `/admin/bank-sampah/kategori/${kategori.id}`;
                    this.isEditKategoriOpen = true;
                },

                openEditTransaksi(transaksi) {
                    this.editTransaksiData = { ...transaksi };
                    // Ambil format YYYY-MM-DD aja dari timestamp
                    if(transaksi.tanggal_setor) {
                        this.editTransaksiData.tanggal_setor = transaksi.tanggal_setor.split(' ')[0];
                    }
                    this.editTransaksiAction = `/admin/bank-sampah/transaksi/${transaksi.id}`;
                    this.isEditTransaksiOpen = true;
                },

                openDeleteModal(url) {
                    this.deleteUrl = url;
                    this.deleteModalOpen = true;
                },
                closeDeleteModal() {
                    this.deleteModalOpen = false;
                    this.deleteUrl = '';
                }
            }
        }
    </script>
</body>
</html>