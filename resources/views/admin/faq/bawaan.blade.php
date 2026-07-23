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
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #A5D6A7; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #2E7D32; }
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover { background-color: #2E7D32 !important; color: white !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex" x-data="faqWebManager()">

    <aside class="w-64 bg-[#0E4D2B] h-screen text-white flex flex-col shadow-xl fixed z-20">
        <div class="h-20 flex-shrink-0 flex items-center justify-center border-b border-[#2E7D32] bg-[#0A3D22]">
            <h1 class="text-xl font-extrabold tracking-wider">PANEL ADMIN</h1>
        </div>
        
        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-2 custom-scrollbar">
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 px-2">Menu Utama</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg> Dashboard</a>
            @if(Auth::user()->role === 'admin')
            <a href="#" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Halaman Operator</a>
            @endif
            
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-6 px-2">Kustomisasi Web</p>
            <a href="#" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Manajemen Gambar (UI)</a>
            <a href="{{ route('admin.pemetaan.index') }}" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg> Manajemen Peta</a>
            
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-6 px-2">Data & Laporan</p>
            <a href="{{ route('admin.faq.index') }}" class="flex items-center gap-3 bg-[#2E7D32] text-white px-4 py-3 rounded-lg font-bold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Manajemen FAQ</a>
            <a href="#" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> Data Warga</a>
            @if(Auth::user()->role === 'admin')
            <a href="#" class="flex items-center gap-3 sidebar-link text-gray-200 px-4 py-3 rounded-lg font-semibold mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Laporan Web</a>
            @endif
        </nav>
        <div class="p-4 border-t border-[#2E7D32] flex-shrink-0">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm text-[#A5D6A7] hover:text-white transition font-bold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali</a>
        </div>
    </aside>

    <main class="flex-1 ml-64 bg-gray-50 min-h-screen">
        <header class="bg-white h-20 shadow-sm border-b border-gray-200 flex items-center justify-between px-8 z-10 sticky top-0">
            <div class="flex items-center gap-6">
                <h2 class="text-xl font-bold text-gray-800 border-r-2 pr-6 border-gray-300">Manajemen FAQ</h2>
                <nav class="hidden md:flex gap-5 text-sm font-bold text-gray-500">
                    <a href="{{ url('/') }}" class="hover:text-[#0E4D2B] transition">Beranda</a>
                    <a href="{{ route('pemetaan') }}" class="hover:text-[#0E4D2B] transition">Peta Wilayah</a>
                    <a href="{{ route('faq') }}" class="hover:text-[#0E4D2B] transition">Pusat FAQ</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold bg-[#FBC02D] text-[#0E4D2B] px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-400">HAK AKSES: {{ strtoupper(Auth::user()->role) }}</span>
                <div class="h-8 w-px bg-gray-300"></div>
                <button class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 transition focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden border border-[#0E4D2B]">
                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=0E4D2B&background=A5D6A7&bold=true' }}" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                </button>
            </div>
        </header>

        <div class="p-8">
            <div class="mb-6">
                <!-- Tombol kembali di dalam konten -->
                <a href="{{ route('admin.faq.index') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors mb-4">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-[#0E4D2B]">Kelola FAQ Web</h2>
                        <p class="text-gray-500 text-sm">Kelola daftar pertanyaan default yang tampil di halaman FAQ Publik.</p>
                    </div>
                    <button @click="openModal('add')" class="bg-[#0E4D2B] text-white px-5 py-2.5 rounded-lg font-semibold shadow-md hover:bg-green-800 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah FAQ Web
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex justify-between items-center font-bold shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 hover:text-green-900 text-2xl leading-none">&times;</button>
                </div>
            @endif

            <!-- TABEL BAWAAN WEB -->
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Pertanyaan</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($faqs as $faq)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-[#0E4D2B] text-lg mb-1">{{ $faq->pertanyaan }}</div>
                            </td>
                            <td class="px-6 py-4 flex items-center justify-center gap-2">
                                <button @click="openModal('edit', {{ json_encode($faq) }})" class="bg-yellow-400 hover:bg-yellow-500 text-white p-1.5 rounded-lg transition shadow-sm" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button @click="openDeleteModal('{{ route('admin.faq.bawaan.destroy', $faq->id) }}')" class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-lg transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-6 py-10 text-center text-gray-500">Belum ada FAQ Bawaan Web.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MODAL FORM TAMBAH / EDIT FAQ WEB -->
            <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
                    <div class="bg-[#0E4D2B] p-5 text-white flex justify-between items-center">
                        <h3 class="text-xl font-bold" x-text="modalTitle"></h3>
                        <button type="button" @click="closeModal()" class="text-white hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form :action="formAction" method="POST" class="p-6">
                        @csrf 
                        <input type="hidden" name="_method" :value="formMethod">
                        
                        <div class="mb-5">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan <span class="text-red-500">*</span></label>
                            <input type="text" name="pertanyaan" x-model="formData.pertanyaan" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B]" placeholder="Ketikkan pertanyaan...">
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jawaban <span class="text-red-500">*</span></label>
                            <textarea name="jawaban" x-model="formData.jawaban" rows="4" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B] focus:ring-opacity-50" placeholder="Ketikkan jawaban Anda di sini..."></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-5 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="col-span-2"><p class="text-xs font-bold text-gray-500 uppercase">Halaman Tujuan (Opsional)</p></div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 mb-1">Halaman Tujuan</label>
                                <select name="action_link" x-model="formData.action_link" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]">
                                    <!-- Opsi Tidak Ada ditambahkan di sini, Pilih Halaman di-hide -->
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
                                <input type="text" name="action_button_text" x-model="formData.action_button_text" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:ring-[#0E4D2B]" placeholder="Cth: Lihat Halaman">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <button type="button" @click="closeModal()" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                            <button type="submit" class="px-5 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg shadow hover:bg-green-800 transition">Simpan FAQ Web</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL HAPUS -->
            <div x-show="deleteModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-70 p-4">
                <div @click.away="closeDeleteModal()" class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full text-center">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Hapus FAQ Bawaan?</h3>
                    <div class="flex justify-center gap-3 mt-6">
                        <button @click="closeDeleteModal()" class="px-6 py-2.5 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300">Batal</button>
                        <form :action="deleteUrl" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 shadow-md">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script>
    function faqWebManager() {
        return {
            isModalOpen: false, deleteModalOpen: false, deleteUrl: '', modalTitle: '', formAction: '', formMethod: '',
            formData: { id: '', pertanyaan: '', jawaban: '', action_button_text: '', action_link: '' },
            openModal(mode, data = null) {
                if(mode === 'edit') {
                    this.formData = { ...data };
                    this.formAction = `/admin/manajemen-faq/web/${data.id}`;
                    this.formMethod = 'PUT';
                    this.modalTitle = 'Edit FAQ Web';
                } else {
                    this.formData = { id: '', pertanyaan: '', jawaban: '', action_button_text: '', action_link: '' };
                    this.formAction = '{{ route('admin.faq.bawaan.store') }}';
                    this.formMethod = 'POST';
                    this.modalTitle = 'Tambah FAQ Web';
                }
                this.isModalOpen = true;
            },
            closeModal() { this.isModalOpen = false; },
            openDeleteModal(url) { this.deleteUrl = url; this.deleteModalOpen = true; },
            closeDeleteModal() { this.deleteModalOpen = false; this.deleteUrl = ''; }
        }
    }
    </script>
</body>
</html>