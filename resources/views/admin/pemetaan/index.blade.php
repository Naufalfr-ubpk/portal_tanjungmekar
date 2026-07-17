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
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="mapManager()">

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
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background=A5D6A7&bold=true';">
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

        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-2xl font-extrabold text-gray-800">Daftar Titik Peta</h3>
                    <p class="text-gray-500 text-sm mt-1">Kelola data Kelurahan, Bank Sampah, dan Rukun Warga.</p>
                </div>
                <button @click="openAdd()" class="bg-[#0E4D2B] hover:bg-[#2E7D32] text-white px-5 py-2.5 rounded-lg font-bold shadow-md transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Titik Baru
                </button>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="p-4 font-bold">Judul / Kategori</th>
                            <th class="p-4 font-bold">Pengelola / Kontak</th>
                            <th class="p-4 font-bold">Koordinat</th>
                            <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($locations as $loc)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <p class="font-bold text-gray-800 text-base">{{ $loc->title }}</p>
                                    <span class="inline-block px-2 py-1 mt-1 text-[10px] font-bold rounded-full 
                                        {{ $loc->type == 'kelurahan' ? 'bg-blue-100 text-blue-700' : ($loc->type == 'banksampah' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }} uppercase">
                                        {{ $loc->type }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <p class="text-sm font-semibold text-gray-800">{{ $loc->manager_label }} {{ $loc->manager_name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $loc->contact_label }} {{ $loc->contact_number ?? '-' }}</p>
                                </td>
                                <td class="p-4">
                                    <p class="text-xs font-mono text-gray-600 bg-gray-100 px-2 py-1 rounded inline-block border border-gray-200">{{ $loc->latitude }}, {{ $loc->longitude }}</p>
                                </td>
                                <td class="p-4 flex items-center justify-center gap-2">
                                    <button @click="openEdit({{ $loc->toJson() }})" class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-lg transition shadow-sm" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <form action="{{ route('admin.pemetaan.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus titik ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition shadow-sm" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 font-medium">Belum ada titik peta yang ditambahkan. Klik tombol hijau di atas untuk memulai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div x-show="openModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 p-4 overflow-y-auto">
        <div @click.away="closeModal()" class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full flex flex-col md:flex-row overflow-hidden max-h-[90vh]">
            
            <div class="w-full md:w-1/2 bg-gray-100 relative min-h-[300px]">
                <div id="modalMap" class="absolute inset-0 z-0"></div>
                <div class="absolute top-4 left-4 z-10 bg-white px-3 py-2 rounded-lg shadow font-bold text-xs text-[#0E4D2B] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                    Klik Peta / Geser Jarum untuk set Kordinat
                </div>
            </div>

            <form :action="formAction" method="POST" class="w-full md:w-1/2 p-6 flex flex-col h-full overflow-y-auto">
                @csrf
                <template x-if="isEdit"><input type="hidden" name="_method" value="PUT"></template>
                
                <h3 class="text-xl font-bold text-gray-800 border-b border-gray-200 pb-3 mb-4" x-text="isEdit ? 'Edit Titik Lokasi' : 'Tambah Titik Baru'"></h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1">Kategori</label>
                            <select name="type" x-model="form.type" @change="autoSetLabels()" class="w-full border-gray-300 rounded-lg text-sm focus:ring-[#0E4D2B] focus:border-[#0E4D2B]">
                                <option value="rw">Rukun Warga (RW)</option>
                                <option value="banksampah">Bank Sampah</option>
                                <option value="kelurahan">Kantor Kelurahan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1">Judul Tempat</label>
                            <input type="text" name="title" x-model="form.title" placeholder="Cth: Bank Sampah RW 04" class="w-full border-gray-300 rounded-lg text-sm focus:ring-[#0E4D2B]" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">Label Pengelola</label>
                            <input type="text" name="manager_label" x-model="form.manager_label" class="w-full border-gray-300 rounded-md text-sm mt-1" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">Nama Lengkap</label>
                            <input type="text" name="manager_name" x-model="form.manager_name" placeholder="Cth: Bapak Budi" class="w-full border-gray-300 rounded-md text-sm mt-1" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">Label Kontak</label>
                            <input type="text" name="contact_label" x-model="form.contact_label" class="w-full border-gray-300 rounded-md text-sm mt-1" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">No. Handphone</label>
                            <input type="text" name="contact_number" x-model="form.contact_number" placeholder="Cth: 0812-XXXX-XXXX" class="w-full border-gray-300 rounded-md text-sm mt-1">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1">Latitude</label>
                            <input type="text" name="latitude" x-model="form.latitude" class="w-full border-gray-300 rounded-lg text-sm bg-gray-100 font-mono" readonly required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1">Longitude</label>
                            <input type="text" name="longitude" x-model="form.longitude" class="w-full border-gray-300 rounded-lg text-sm bg-gray-100 font-mono" readonly required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Alamat Lengkap <span class="text-[10px] font-normal text-gray-400">(Bisa diedit manual)</span></label>
                        <textarea name="address" x-model="form.address" rows="3" placeholder="Alamat otomatis terisi saat peta diklik..." class="w-full border-gray-300 rounded-lg text-sm focus:ring-[#0E4D2B]" required></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" @click="closeModal()" class="px-5 py-2.5 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg shadow hover:bg-[#2E7D32] transition">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function mapManager() {
            return {
                openModal: false,
                isEdit: false,
                formAction: '',
                form: {},
                mapInstance: null,
                markerInstance: null,

                resetForm() {
                    this.form = { id: '', type: 'rw', title: '', manager_label: 'Ketua RW', manager_name: '', contact_label: 'Kontak', contact_number: '', address: '', latitude: -6.3026362, longitude: 107.2917726 };
                },

                autoSetLabels() {
                    if(this.form.type === 'kelurahan') { this.form.manager_label = 'Lurah:'; this.form.contact_label = 'Resepsionis:'; }
                    else if(this.form.type === 'banksampah') { this.form.manager_label = 'Pengelola:'; this.form.contact_label = 'Kontak:'; }
                    else { this.form.manager_label = 'Ketua RW:'; this.form.contact_label = 'Kontak:'; }
                },

                openAdd() {
                    this.isEdit = false;
                    this.formAction = '{{ route("admin.pemetaan.store") }}';
                    this.resetForm();
                    this.openModal = true;
                    this.initMap(this.form.latitude, this.form.longitude);
                },

                openEdit(data) {
                    this.isEdit = true;
                    this.formAction = `/admin/pemetaan/${data.id}`;
                    this.form = { ...data };
                    this.openModal = true;
                    this.initMap(this.form.latitude, this.form.longitude);
                },

                closeModal() {
                    this.openModal = false;
                },

                initMap(lat, lng) {
                    setTimeout(() => {
                        if(!this.mapInstance) {
                            this.mapInstance = L.map('modalMap').setView([lat, lng], 16);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(this.mapInstance);

                            this.markerInstance = L.marker([lat, lng], {draggable: true}).addTo(this.mapInstance);

                            this.markerInstance.on('dragend', (e) => {
                                let pos = e.target.getLatLng();
                                this.updateLocation(pos.lat, pos.lng);
                            });

                            this.mapInstance.on('click', (e) => {
                                this.markerInstance.setLatLng(e.latlng);
                                this.updateLocation(e.latlng.lat, e.latlng.lng);
                            });
                        } else {
                            this.mapInstance.invalidateSize(); 
                            this.mapInstance.setView([lat, lng], 16);
                            this.markerInstance.setLatLng([lat, lng]);
                        }
                    }, 300);
                },

                updateLocation(lat, lng) {
                    this.form.latitude = lat.toFixed(7);
                    this.form.longitude = lng.toFixed(7);
                    
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                        .then(res => res.json())
                        .then(data => {
                            if(data.display_name) {
                                this.form.address = data.display_name;
                            }
                        });
                }
            }
        }
    </script>
</body>
</html>