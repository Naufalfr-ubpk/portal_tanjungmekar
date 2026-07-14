<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | Portal Tanjungmekar</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex">

    <aside class="w-64 bg-[#0E4D2B] min-h-screen text-white flex flex-col shadow-xl fixed">
        <div class="h-20 flex items-center justify-center border-b border-[#2E7D32] bg-[#0A3D22]">
            <h1 class="text-xl font-extrabold tracking-wider">PANEL ADMIN</h1>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-4 px-2">Menu Utama</p>
            <a href="#" class="flex items-center gap-3 bg-[#2E7D32] text-white px-4 py-3 rounded-lg font-bold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <p class="text-xs font-bold text-[#A5D6A7] uppercase tracking-wider mb-2 mt-6 px-2">Kustomisasi Web</p>
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Teks & Logo (UI)
            </a>
            <a href="#" class="flex items-center gap-3 hover:bg-[#2E7D32] text-gray-200 hover:text-white px-4 py-3 rounded-lg font-semibold transition">
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
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm text-[#A5D6A7] hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Lihat Web Warga
            </a>
        </div>
    </aside>

    <main class="flex-1 ml-64 bg-gray-50 min-h-screen">
        <header class="bg-white h-20 shadow-sm border-b border-gray-200 flex items-center justify-between px-8">
            <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
            
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold bg-[#FBC02D] text-[#0E4D2B] px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-400">Hak Akses: Super Admin</span>
                <div class="h-8 w-px bg-gray-300"></div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0E4D2B] text-white flex items-center justify-center font-bold">
                        A
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8 border-l-8 border-[#0E4D2B]">
                <h3 class="text-2xl font-extrabold text-gray-800">Selamat Datang di Ruang Kendali, Boss!</h3>
                <p class="text-gray-500 mt-2">Ini adalah *Content Management System* (CMS) khusus untuk mengatur keseluruhan Portal Tanjungmekar tanpa perlu menyentuh *codingan* lagi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <h4 class="text-gray-500 font-bold text-sm uppercase tracking-wider mb-1">Total Warga Terdaftar</h4>
                    <p class="text-3xl font-extrabold text-[#0E4D2B]">124 <span class="text-sm font-medium text-gray-400">Akun</span></p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <h4 class="text-gray-500 font-bold text-sm uppercase tracking-wider mb-1">Pengajuan FAQ Baru</h4>
                    <p class="text-3xl font-extrabold text-yellow-600">3 <span class="text-sm font-medium text-gray-400">Menunggu Validasi</span></p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <h4 class="text-gray-500 font-bold text-sm uppercase tracking-wider mb-1">Laporan Error Web</h4>
                    <p class="text-3xl font-extrabold text-red-600">0 <span class="text-sm font-medium text-gray-400">Laporan</span></p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>