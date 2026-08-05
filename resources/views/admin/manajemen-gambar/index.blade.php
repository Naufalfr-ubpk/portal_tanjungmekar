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

    $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset(str_starts_with($rawAvatar, 'storage/') ? $rawAvatar : 'storage/' . $rawAvatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . "&color=$avatarColor&background=$avatarBgColor&bold=true";

@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Gambar | Portal Tanjungmekar</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- CDN Cropper.js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: {{ $isAdminTheme ? '#A5D6A7' : '#F9A825' }}; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: {{ $isAdminTheme ? '#2E7D32' : '#F57F17' }}; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="imageManager()">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" style="display: none;"></div>

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
            <a id="active-menu-item" href="{{ route('admin.manajemen-gambar.index', $modeParam) }}" class="flex items-center gap-3 {{ $activeBg }} {{ $activeText }} px-4 py-3 rounded-lg font-bold transition {{ $isAdminTheme ? '' : 'shadow-sm' }}">
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
            
            @if($isAdminTheme)
            <a href="{{ route('admin.laporan-web.index', isset($modeParam) ? $modeParam : []) }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition mb-4">
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


                <h2 class="text-lg md:text-xl font-bold text-gray-800 border-r-2 pr-4 md:pr-6 border-gray-300">Manajemen Gambar</h2>
                <!-- Tambahan Menu Navigasi -->
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

                            <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(str_starts_with(Auth::user()->avatar, 'storage/') ? Auth::user()->avatar : 'storage/' . Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background={{ Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7' }}&bold=true';" alt="Avatar" class="w-full h-full object-cover">

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

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-[#0E4D2B]">Gambar (Hero Image)</h3>
                        <p class="text-sm text-gray-500 mt-1">Gambar utama yang tampil di beranda (Landing Page).</p>
                    </div>
                    
                    @if($hasCustomImage)
                    <form action="{{ route('admin.manajemen-gambar.destroy') }}" method="POST" onsubmit="return confirm('Yakin ingin mereset gambar ke bawaan (kelurahan.png)?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full md:w-auto bg-red-100 text-red-700 px-5 py-2.5 rounded-lg font-bold hover:bg-red-200 transition flex items-center justify-center gap-2 border border-red-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Reset ke Default
                        </button>
                    </form>
                    @endif
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Preview Gambar Saat Ini -->
                        <div>
                            <h4 class="text-sm font-bold text-gray-700 uppercase tracking-widest mb-3">Gambar Saat Ini Tampil</h4>
                            <div class="aspect-w-16 aspect-h-9 rounded-xl overflow-hidden border-4 border-gray-200 shadow-inner bg-gray-100 flex items-center justify-center">
                                <img src="{{ $currentImage }}" alt="Current Hero" class="object-cover w-full h-full">
                            </div>
                        </div>

                        <!-- Form Upload & Crop Baru -->
                        <div>
                            <h4 class="text-sm font-bold text-[#0E4D2B] uppercase tracking-widest mb-3">Ganti Gambar Baru</h4>
                            
                            <input type="file" id="image-upload" accept="image/png, image/jpeg, image/jpg" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#A5D6A7] file:text-[#0E4D2B] hover:file:bg-[#66BB6A] transition cursor-pointer border border-gray-300 rounded-lg p-1 bg-gray-50 mb-4" onchange="previewImage(event)">

                            <p class="text-xs text-gray-500 mb-4">*Disarankan memilih gambar dengan orientasi Landscape.</p>

                            <!-- Area Cropping (Hidden by default) -->
                            <div id="cropper-container" style="display: none;">
                                <div class="w-full max-h-[300px] overflow-hidden rounded-xl border-2 border-gray-300 bg-black mb-4">
                                    <img id="image-preview" src="" class="max-w-full">
                                </div>

                                <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                                    <div class="flex gap-2 w-full sm:w-auto">
                                        <button type="button" onclick="rotateImage(-90)" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 p-2 rounded-lg font-semibold transition flex justify-center items-center gap-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                        </button>
                                        <button type="button" onclick="rotateImage(90)" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 p-2 rounded-lg font-semibold transition flex justify-center items-center gap-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6"></path></svg>
                                        </button>
                                    </div>
                                    
                                    <form id="upload-form" action="{{ route('admin.manajemen-gambar.update') }}" method="POST" class="w-full sm:w-auto m-0">
                                        @csrf
                                        <input type="hidden" name="cropped_image" id="cropped_image">
                                        <button type="button" onclick="saveImage()" class="w-full sm:w-auto bg-[#0E4D2B] text-white px-6 py-2.5 rounded-lg font-bold hover:bg-[#2E7D32] transition shadow-md">
                                            Terapkan & Simpan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        function imageManager() {
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

        let cropper;
        const image = document.getElementById('image-preview');

        function previewImage(event) {
            const files = event.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                    document.getElementById('cropper-container').style.display = 'block';

                    if (cropper) { cropper.destroy(); }
                    
                    // Ratio 16:9 ngunci proporsi Landscape persis seperti request lu
                    cropper = new Cropper(image, {
                        aspectRatio: 16 / 9,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 1,
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        }

        function rotateImage(degree) {
            if (cropper) { cropper.rotate(degree); }
        }




        function saveImage() {
            if (cropper) {
                // Konversi hasil crop ke Base64 (resolusi ditahan di 1280x720 biar enteng dimuat)
                const canvas = cropper.getCroppedCanvas({
                    width: 1280,
                    height: 720
                });
                
                const base64data = canvas.toDataURL('image/png', 0.9);
                document.getElementById('cropped_image').value = base64data;
                document.getElementById('upload-form').submit();
            }
        }



    </script>
</body>
</html>