@php
    $isOp = Auth::user()->role === 'operator' || request('mode') === 'operator';
    $modeParam = (Auth::user()->role === 'admin' && $isOp) ? ['mode' => 'operator'] : [];
    $navLinkText = $isOp ? 'text-[#0E4D2B]' : 'text-gray-200';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen FAQ | Admin Portal</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        @if($isOp)
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #F9A825; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #F57F17; }
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover { background-color: #F9A825 !important; color: #0A3D22 !important; }
        @else
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #A5D6A7; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #2E7D32; }
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover { background-color: #2E7D32 !important; color: white !important; }
        @endif
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="faqManager()">

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

            <p class="text-xs font-bold uppercase tracking-wider mb-2 px-2 {{ $isOp ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Menu Utama</p>
            <a href="{{ $isOp ? route('operator.dashboard') : route('admin.dashboard') }}" class="flex items-center gap-3 sidebar-link {{ $navLinkText }} px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg> Dashboard</a>
            
            @if(Auth::user()->role === 'admin' && !$isOp)
            <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Halaman Operator</a>
            @endif
            
            <p class="text-xs font-bold uppercase tracking-wider mb-2 mt-6 px-2 {{ $isOp ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Kustomisasi Web</p>
            <a href="{{ route('admin.manajemen-gambar.index', isset($modeParam) ? $modeParam : []) }}" class="flex items-center gap-3 sidebar-link {{ $navLinkText }} px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Manajemen Gambar</a>
            <a href="{{ route('admin.pemetaan.index', $modeParam) }}" class="flex items-center gap-3 sidebar-link {{ $navLinkText }} px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg> Manajemen Peta</a>
            
            <p class="text-xs font-bold uppercase tracking-wider mb-2 mt-6 px-2 {{ $isOp ? 'text-[#0A3D22]' : 'text-[#A5D6A7]' }}">Data & Laporan</p>
            <a href="{{ route('admin.faq.index', $modeParam) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold {{ $isOp ? 'bg-white text-[#0E4D2B] shadow-sm' : 'bg-[#2E7D32] text-white' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Manajemen FAQ</a>
            
            <a href="{{ route('admin.data-warga.index', $modeParam) }}" class="flex items-center gap-3 sidebar-link {{ $navLinkText }} px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> Data Warga</a>
            
            <a href="{{ route('admin.bank-sampah.index', $modeParam) }}" class="flex items-center gap-3 sidebar-link {{ isset($navLinkText) ? $navLinkText : (isset($navLink) ? $navLink : '') }} px-4 py-3 rounded-lg font-semibold transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg> Bank Sampah</a>

            @if(Auth::user()->role === 'admin' && !$isOp)
            <a href="{{ route('admin.laporan-web.index', isset($modeParam) ? $modeParam : []) }}" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Laporan Web</a>
            @endif
        </nav>
        <div class="p-4 border-t flex-shrink-0 {{ $isOp ? 'border-yellow-500' : 'border-[#2E7D32]' }}">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm transition font-bold {{ $isOp ? 'text-[#0E4D2B] hover:text-[#0A3D22]' : 'text-[#A5D6A7] hover:text-white' }}"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali</a>
        </div>
    </aside>

    <main class="flex-1 w-full min-w-0 md:ml-64 bg-gray-50 min-h-screen transition-all duration-300 overflow-x-hidden">
        <!-- HEADER KONTEN -->
        <header class="bg-white h-20 shadow-sm border-b border-gray-200 flex items-center justify-between px-4 md:px-8 z-10 sticky top-0 w-full">
            <div class="flex items-center gap-3 md:gap-6">
                <!-- HAMBURGER BUTTON -->
                <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg focus:outline-none transition mr-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Manajemen FAQ</h2>
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

        <div class="p-4 md:p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-[#0E4D2B]">Daftar Pengajuan Pertanyaan Warga</h2>
                    <p class="text-gray-500 text-sm">Jawab dan publikasikan keluhan atau pertanyaan warga.</p>
                </div>
                @if(Auth::user()->role === 'admin' && !$isOp)
                <a href="{{ route('admin.faq.bawaan') }}" class="w-full md:w-auto text-center bg-[#0E4D2B] text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-green-800 transition shadow-md">Kelola FAQ Web</a>
                @endif
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex justify-between items-center font-bold shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 hover:text-green-900 text-2xl leading-none">&times;</button>
                </div>
            @endif

            <!-- MENU TABS -->
            <div class="flex overflow-x-auto hide-scroll gap-2 md:gap-3 mb-4 pb-2">
                <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-[#0E4D2B] text-white' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Semua</button>
                <button @click="activeTab = 'pending'" :class="activeTab === 'pending' ? 'bg-yellow-500 text-white border-yellow-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Menunggu Jawaban</button>
                <button @click="activeTab = 'dipublikasi'" :class="activeTab === 'dipublikasi' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Dipublikasi</button>
                <button @click="activeTab = 'ditolak'" :class="activeTab === 'ditolak' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="whitespace-nowrap px-4 md:px-5 py-2 rounded-full font-bold shadow-sm border transition text-xs md:text-sm">Ditolak</button>
            </div>

            <!-- TABEL -->
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden w-full">
                <div class="overflow-x-auto w-full custom-scrollbar">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase whitespace-nowrap">Nama / Waktu</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase w-1/3 whitespace-nowrap">Pertanyaan</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase whitespace-nowrap">Status</th>
                                <th class="px-4 md:px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody x-show="activeTab === 'semua'" class="divide-y divide-gray-200">
                            @forelse($faqs as $faq)
                                @include('admin.faq.partials.row_warga', ['faq' => $faq])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, belum ada pengajuan pertanyaan dari warga.</td></tr>
                            @endforelse
                        </tbody>
                        <tbody x-show="activeTab === 'pending'" style="display:none;" class="divide-y divide-gray-200">
                            @forelse($faqs->where('status', 'pending') as $faq)
                                @include('admin.faq.partials.row_warga', ['faq' => $faq])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, tidak ada pengajuan yang menunggu jawaban.</td></tr>
                            @endforelse
                        </tbody>
                        <tbody x-show="activeTab === 'dipublikasi'" style="display:none;" class="divide-y divide-gray-200">
                            @forelse($faqs->where('status', 'dipublikasi') as $faq)
                                @include('admin.faq.partials.row_warga', ['faq' => $faq])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, belum ada pengajuan pertanyaan yang dipublikasi.</td></tr>
                            @endforelse
                        </tbody>
                        <tbody x-show="activeTab === 'ditolak'" style="display:none;" class="divide-y divide-gray-200">
                            @forelse($faqs->where('status', 'ditolak') as $faq)
                                @include('admin.faq.partials.row_warga', ['faq' => $faq])
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">Mohon maaf, belum ada pengajuan pertanyaan yang ditolak.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL FORM ULAS / JAWAB FAQ -->
            <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden max-h-[90vh] overflow-y-auto custom-scrollbar">
                    <div class="bg-[#0E4D2B] p-5 text-white flex justify-between items-center">
                        <h3 class="text-xl font-bold">Ulas Pertanyaan Warga</h3>
                        <button type="button" @click="closeModal()" class="text-white hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form :action="`/admin/manajemen-faq/${formData.id}`" method="POST" class="p-6">
                        @csrf @method('PUT')
                        
                        <div class="bg-gray-50 p-4 rounded-xl mb-6 border border-gray-200">
                            <p class="text-xs font-bold text-gray-500 uppercase mb-1" x-text="formData.nama_penanya"></p>
                            <h4 class="text-lg font-extrabold text-gray-900 mb-2" x-text="formData.pertanyaan"></h4>
                            <p class="text-sm text-gray-600 italic" x-text="formData.detail_pertanyaan ? `&quot;${formData.detail_pertanyaan}&quot;` : 'Tidak ada detail tambahan.'"></p>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jawaban <span class="text-red-500">*</span></label>

                            <textarea name="jawaban" x-model="formData.jawaban" rows="4" :required="formData.status !== 'ditolak'" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B]" placeholder="Ketikkan jawaban Anda di sini..."></textarea>

                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="col-span-1 sm:col-span-2"><p class="text-xs font-bold text-gray-500 uppercase">Halaman Tujuan (Opsional)</p></div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 mb-1">Halaman Tujuan</label>
                                <select name="action_link" x-model="formData.action_link" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]">
                                    <option value="" disabled hidden>-- Pilih Halaman --</option>
                                    <option value="">Tidak Ada</option>
                                    <option value="/dashboard">Dashboard</option>
                                    <option value="/pemetaan">Peta Wilayah</option>
                                    <option value="/faq">Pusat Bantuan FAQ</option>
                                    <option value="/laporan-web">Layanan Pengaduan Web</option>
                                    <option value="/profile">Halaman Profil</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 mb-1">Teks Tombol</label>
                                <input type="text" name="action_button_text" x-model="formData.action_button_text" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]" placeholder="Bebas diketik...">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Status Visibilitas</label>

                            <select name="status" x-model="formData.status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B]">
                                <option value="pending">Tetap Pending (Belum dipublikasi)</option>
                                <option value="dipublikasi">Dipublikasi (Tampil di FAQ)</option>
                                <option value="ditolak">Ditolak (Pindah ke Tab Ditolak)</option>
                            </select>

                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <button type="button" @click="closeModal()" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                            <button type="submit" class="px-5 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg shadow hover:bg-green-800 transition">Simpan & Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL KONFIRMASI HAPUS -->

                <div x-show="deleteModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
                    <div @click.away="closeDeleteModal()" class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full text-center relative">
                        
                        <!-- Tombol X Tambahan -->
                        <button @click="closeDeleteModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>

                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4 mt-2">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Hapus Pertanyaan?</h3>
                        
                        <!-- Teks yang disesuaikan -->

                        <p class="text-sm text-gray-500 mb-6" x-text="deleteStatus === 'ditolak' ? 'Pertanyaan ini akan dihapus secara PERMANEN dari sistem. Apakah anda yakin untuk menghapusnya? ' : 'Pertanyaan ini akan dipindahkan ke tab Ditolak terlebih dahulu.'"></p>
                        
                        <div class="flex justify-center gap-3">
                            <button @click="closeDeleteModal()" class="px-6 py-2.5 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                            <form :action="deleteUrl" method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-6 py-2.5 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 shadow-md">Ya, Hapus!</button>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </main>

    <script>
    function faqManager() {
        return {
            sidebarOpen: false, 
            activeTab: 'semua', isModalOpen: false, deleteModalOpen: false, deleteUrl: '',

            formData: { id: '', pertanyaan: '', detail_pertanyaan: '', nama_penanya: '', jawaban: '', status: 'pending', action_button_text: '', action_link: '' }, deleteStatus: '',

            openModal(data) {
                this.formData = { ...data };
                this.isModalOpen = true;
            },
            closeModal() { this.isModalOpen = false; },
            
            openDeleteModal(url, status = '') { this.deleteUrl = url; this.deleteStatus = status; this.deleteModalOpen = true; },

            closeDeleteModal() { this.deleteModalOpen = false; this.deleteUrl = ''; }
        }
    }
    </script>
</body>
</html>