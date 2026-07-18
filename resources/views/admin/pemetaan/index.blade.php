<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Peta | Admin Portal</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="mapManager()" x-init="initMap()">

    <!-- SIDEBAR ADMIN -->
    <aside class="w-64 bg-[#0E4D2B] min-h-screen text-white flex flex-col shadow-xl fixed z-20">
        <div class="h-20 flex items-center justify-center border-b border-[#2E7D32] bg-[#0A3D22]">
            <h1 class="text-xl font-extrabold tracking-wider">PANEL ADMIN</h1>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-4 px-2">Menu Utama</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-6 px-2">Kustomisasi Web</p>
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Teks & Logo (UI)
            </a>
            <a href="{{ route('admin.pemetaan.index') }}" class="flex items-center gap-3 bg-[#2E7D32] text-white px-4 py-3 rounded-lg font-bold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                Manajemen Peta
            </a>
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-6 px-2">Data & Laporan</p>
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Validasi FAQ
            </a>
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Warga
            </a>
        </nav>
        <div class="p-4 border-t border-[#2E7D32]">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm text-[#A5D6A7] hover:text-white transition font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </aside>

    <main class="flex-1 ml-64 bg-gray-50 min-h-screen">
        <!-- HEADER KONTEN -->
        <header class="bg-white h-20 shadow-sm border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center gap-6">
                <h2 class="text-xl font-bold text-gray-800 border-r-2 pr-6 border-gray-300">Manajemen Peta</h2>
                <nav class="hidden md:flex gap-5 text-sm font-bold text-gray-500">
                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold bg-[#FBC02D] text-[#0E4D2B] px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-400">HAK AKSES: ADMIN</span>
                <div class="h-8 w-px bg-gray-300"></div>
                
                <div x-data="{ openAdminProfile: false }" class="relative">
                    <button @click="openAdminProfile = !openAdminProfile" class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden border border-[#0E4D2B]">
                            <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=0E4D2B&background=A5D6A7&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openAdminProfile" @click.away="openAdminProfile = false" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 font-semibold">Keluar Akun</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- AREA KONTEN UTAMA -->
        <div class="p-6">
            <!-- Header Konten & Tombol Tambah -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-[#0E4D2B]">Daftar Titik Peta</h2>
                    <p class="text-gray-500 text-sm">Kelola data Kelurahan, Bank Sampah, dan Rukun Warga.</p>
                </div>
                <button @click="openModal('add')" class="bg-[#0E4D2B] text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-green-800 transition flex items-center gap-2 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Lokasi Baru
                </button>
            </div>

            <!-- Alert Success Dismissible (Bisa disilang) -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex justify-between items-center font-bold shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 hover:text-green-900 text-2xl leading-none">&times;</button>
                </div>
            @endif

            <!-- TAB FILTER PENGELOMPOKAN -->
            <div class="flex gap-3 mb-4">
                <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-[#0E4D2B] text-white' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="px-5 py-2 rounded-full font-bold shadow-sm border transition text-sm">Semua Titik</button>
                <button @click="activeTab = 'kelurahan'" :class="activeTab === 'kelurahan' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="px-5 py-2 rounded-full font-bold shadow-sm border transition text-sm">Kantor Kelurahan</button>
                <button @click="activeTab = 'rw'" :class="activeTab === 'rw' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="px-5 py-2 rounded-full font-bold shadow-sm border transition text-sm">Rukun Warga (RW)</button>
                <button @click="activeTab = 'banksampah'" :class="activeTab === 'banksampah' ? 'bg-yellow-500 text-white border-yellow-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'" class="px-5 py-2 rounded-full font-bold shadow-sm border transition text-sm">Bank Sampah</button>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Judul / Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pengelola / Kontak</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Koordinat & Gmaps</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($locations as $loc)
                        <!-- Logika Alpine buat nyembunyiin baris sesuai Tab yang diklik -->
                        <tr class="hover:bg-gray-50 transition" x-show="activeTab === 'semua' || activeTab === '{{ $loc->type }}'">
                            <td class="px-6 py-4">
                                <div class="font-bold text-[#0E4D2B] text-base">{{ $loc->title }}</div>
                                <span class="inline-block px-2 py-1 mt-1 text-[10px] font-bold rounded-full 
                                    {{ $loc->type == 'kelurahan' ? 'bg-blue-100 text-blue-700' : ($loc->type == 'banksampah' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }} uppercase">
                                    {{ $loc->type == 'rw' ? 'Rukun Warga (RW)' : $loc->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900">{{ $loc->manager_label }}: {{ $loc->manager_name }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $loc->contact_label }}: {{ $loc->contact_number ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs font-mono text-gray-600 bg-gray-100 px-2 py-1 rounded inline-block border border-gray-200">{{ $loc->koordinat }}</div>
                                @if($loc->gmaps_link)
                                    <div class="mt-2">
                                        <!-- Teks Link Diubah Sesuai Request -->
                                        <a href="{{ $loc->gmaps_link }}" target="_blank" class="text-xs text-blue-600 hover:underline font-semibold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            Buka di Google Map
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex items-center justify-center gap-3">
                                <button @click="openModal('edit', {{ json_encode($loc) }})" class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-lg transition shadow-sm" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <!-- Tombol Hapus memanggil Modal Delete Custom -->
                                <button @click="openDeleteModal('{{ route('admin.pemetaan.destroy', $loc->id) }}')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition shadow-sm" title="Hapus Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">
                                Belum ada titik peta yang ditambahkan. Klik tombol di atas untuk memulai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MODAL FORM UTAMA (Tambah/Edit) -->
            <!-- Dihilangkan @click.away="closeModal()" Biar gak cancel kalau klik luar -->
            <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-70 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl flex flex-col md:flex-row overflow-hidden relative">
                    
                    <!-- MAP AREA -->
                    <div class="md:w-1/2 h-64 md:h-auto relative bg-gray-100">
                        <div class="absolute top-4 right-4 z-[400] bg-white px-3 py-1.5 rounded shadow text-xs font-bold text-[#0E4D2B] flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                            Geser Jarum / Klik Peta
                        </div>
                        <div class="absolute bottom-4 left-4 z-[400] flex flex-col gap-2">
                            <button @click="resetMap()" type="button" class="bg-white p-2 rounded shadow hover:bg-gray-100" title="Reset Posisi">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </button>
                            <button @click="getMyLocation()" type="button" class="bg-white p-2 rounded shadow hover:bg-gray-100" title="Lokasi Saya">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <div id="adminMap" class="w-full h-full min-h-[400px] z-10"></div>
                    </div>

                    <!-- FORM AREA -->
                    <div class="md:w-1/2 p-6 max-h-[85vh] overflow-y-auto">
                        <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-[#0E4D2B]" x-text="modalTitle"></h3>
                            <button @click="closeModal()" type="button" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <form :action="formAction" method="POST">
                            @csrf
                            <input type="hidden" name="_method" :value="formMethod">
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                                    <select name="type" x-model="formData.type" @change="autoSetLabels()" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]" required>
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

                            <div class="grid grid-cols-2 gap-4 mb-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Label Pengelola</label>
                                    <input type="text" name="manager_label" x-model="formData.manager_label" class="w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                                    <input type="text" name="manager_name" x-model="formData.manager_name" class="w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Label Kontak</label>
                                    <input type="text" name="contact_label" x-model="formData.contact_label" class="w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">No. Handphone</label>
                                    <input type="text" name="contact_number" x-model="formData.contact_number" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Cth: 0812-XXXX-XXXX">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-xs font-bold text-gray-700 mb-1">Koordinat <span class="text-[10px] font-normal text-gray-500">(Latitude, Longitude)</span></label>
                                <input type="text" id="koordinatInput" name="koordinat" x-model="formData.koordinat" @input="updateMarkerFromInput" class="w-full rounded-md border-gray-300 shadow-sm text-sm bg-blue-50 focus:bg-white font-mono" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Link Google Maps (Opsional)</label>
                                    <input type="text" name="gmaps_link" x-model="formData.gmaps_link" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Teks Tombol Link</label>
                                    <input type="text" name="gmaps_button_text" x-model="formData.gmaps_button_text" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Lengkap <span class="text-[10px] font-normal text-gray-500">(Bisa diedit manual)</span></label>
                                <textarea name="address" id="alamatInput" x-model="formData.address" rows="2" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]" required></textarea>
                            </div>

                            <div class="flex justify-end gap-3 pt-4 border-t">
                                <button type="button" @click="closeModal()" class="px-5 py-2 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                                <button type="submit" class="px-5 py-2 bg-[#0E4D2B] text-white font-bold rounded-lg shadow hover:bg-green-800 transition">Simpan Lokasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL KONFIRMASI HAPUS CUSTOM (Lebih Elegan) -->
            <div x-show="deleteModalOpen" style="display: none;" class="fixed inset-0 z-[60] bg-black bg-opacity-70 flex items-center justify-center p-4">
                <div @click.away="closeDeleteModal()" class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md text-center transform transition-all">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Yakin Ingin Menghapus?</h3>
                    <p class="text-sm text-gray-500 mb-6">Data lokasi ini akan dihapus secara permanen dari peta dan sistem. Anda tidak bisa mengembalikannya.</p>
                    <div class="flex justify-center gap-3">
                        <button @click="closeDeleteModal()" class="px-6 py-2.5 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <form :action="deleteUrl" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition shadow-md">Ya, Hapus Titik!</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    
    <script>
    function mapManager() {
        return {
            activeTab: 'semua', // State buat Tab Filter
            isModalOpen: false,
            modalTitle: 'Tambah Lokasi Baru',
            formAction: '{{ route('admin.pemetaan.store') }}',
            formMethod: 'POST',
            map: null,
            marker: null,
            defaultLat: -6.273213,
            defaultLng: 107.273665,
            formData: {
                type: 'rw', title: '', manager_label: 'Ketua RW', manager_name: '', 
                contact_label: 'Kontak', contact_number: '', koordinat: '', 
                gmaps_link: '', gmaps_button_text: 'Buka di Google Maps', address: ''
            },
            
            // State buat Modal Delete Custom
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
                } else { 
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
                        type: 'rw', title: '', manager_label: 'Ketua RW', manager_name: '', 
                        contact_label: 'Kontak', contact_number: '', koordinat: '', 
                        gmaps_link: '', gmaps_button_text: 'Buka di Google Maps', address: ''
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