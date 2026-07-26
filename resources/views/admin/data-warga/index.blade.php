@php
    $realRole = Auth::user()->role;
    $mode = request()->query('mode');
    
    // Cek apakah Admin sedang simulasi halaman operator
    $isSimulatingOperator = ($realRole === 'admin' && $mode === 'operator');
    
    // Tentukan tema visual (Hanya hijau kalau murni admin dan BUKAN simulasi)
    $isAdminTheme = ($realRole === 'admin' && !$isSimulatingOperator);
    
    // Parameter mode untuk menjaga state di URL saat pindah-pindah link
    $modeParam = $isSimulatingOperator ? ['mode' => 'operator'] : [];

    // Setup Warna UI
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
    
    // Untuk text Hak Akses di pojok kanan atas
    $displayRole = $isSimulatingOperator ? 'operator' : $realRole;
    
    $rawAvatar = Auth::user()->avatar;
    $avatarColor = '0E4D2B';
    $avatarBgColor = $isAdminTheme ? 'A5D6A7' : 'FBC02D';
    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset($rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . "&color=$avatarColor&background=$avatarBgColor&bold=true";
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Warga | Portal Tanjungmekar</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="{ sidebarOpen: false }">

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

            <a href="{{ route('admin.data-warga.index', $modeParam) }}" class="flex items-center gap-3 {{ $activeBg }} {{ $activeText }} px-4 py-3 rounded-lg font-bold transition {{ $isAdminTheme ? '' : 'shadow-sm' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Warga
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
                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Data Warga</h2>
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
                            <img src="{{ $avatarUrl }}" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="hidden sm:inline-block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-600 font-bold" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
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
            @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-extrabold text-[#0E4D2B]">Daftar Warga Terverifikasi</h3>
                    <p class="text-sm text-gray-500 mt-1">Pantau dan kelola data akun warga di sini.</p>
                </div>

                <!-- TABS -->
                <div class="px-6 pt-4 flex gap-6 border-b border-gray-200 text-sm font-semibold">
                    <a href="{{ route('admin.data-warga.index', array_merge(['tab' => 'semua'], $modeParam)) }}" class="pb-3 border-b-2 transition {{ $tab === 'semua' ? 'border-[#0E4D2B] text-[#0E4D2B]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">Semua Akun</a>
                    <a href="{{ route('admin.data-warga.index', array_merge(['tab' => 'manual'], $modeParam)) }}" class="pb-3 border-b-2 transition {{ $tab === 'manual' ? 'border-[#0E4D2B] text-[#0E4D2B]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">Akun User (Manual)</a>
                    <a href="{{ route('admin.data-warga.index', array_merge(['tab' => 'google'], $modeParam)) }}" class="pb-3 border-b-2 transition {{ $tab === 'google' ? 'border-[#0E4D2B] text-[#0E4D2B]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">Akun Google</a>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-200">
                                <th class="px-6 py-4 font-bold">Nama Warga</th>
                                <th class="px-6 py-4 font-bold">Email</th>
                                <th class="px-6 py-4 font-bold">Tipe Akun</th>

                                <th class="px-6 py-4 font-bold text-center uppercase">{{ $isAdminTheme ? 'Tindakan' : 'Aksi' }}</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($warga as $w)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $w->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $w->email }}</td>
                                    <td class="px-6 py-4">
                                        @if($w->google_id)
                                            <span class="inline-flex items-center gap-1 bg-white border border-gray-300 text-gray-700 px-2.5 py-1 rounded-md text-[10px] font-bold tracking-wide shadow-sm">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                                                GOOGLE
                                            </span>
                                        @else
                                            <span class="inline-block bg-[#A5D6A7] text-[#0E4D2B] px-2.5 py-1 rounded-md text-[10px] font-bold tracking-wide">AKUN USER</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($isAdminTheme)
                                            <!-- Tombol Hapus untuk Admin (Bisa hapus semua user) -->
                                            <div x-data="{ showDeleteModal: false }">
                                                <button @click="showDeleteModal = true" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition" title="Hapus Akun">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>

                                                <!-- Delete Modal -->
                                                <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center">
                                                    <div class="fixed inset-0 bg-black bg-opacity-50"></div>
                                                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative z-10 mx-4">
                                                        <div class="flex justify-between items-center mb-5">
                                                            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Hapus</h3>
                                                            <button @click="showDeleteModal = false" class="text-gray-400 hover:text-gray-600">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                            </button>
                                                        </div>
                                                        <p class="text-gray-600 mb-6 text-left text-sm">Apakah Anda yakin ingin menghapus akses akun <strong>{{ $w->name }}</strong>? User harus melakukan registrasi/otorisasi ulang untuk masuk.</p>
                                                        <div class="flex justify-end gap-3">
                                                            <button @click="showDeleteModal = false" class="px-4 py-2 text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Batal</button>
                                                            <form action="{{ route('admin.data-warga.destroy', $w->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition">Ya, Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Tampilan untuk Operator -->
                                            <span class="text-xs text-gray-400 font-semibold">Hanya Lihat</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        <p class="font-semibold text-lg">Belum ada data warga</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: {{ $isAdminTheme ? '#A5D6A7' : '#F9A825' }}; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: {{ $isAdminTheme ? '#2E7D32' : '#F57F17' }}; }
    </style>
</body>
</html>