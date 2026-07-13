<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Layanan (Pengaduan Web)') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-t-8 border-red-600">
                <div class="p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Laporan Kendala Sistem</h3>
                            <p class="text-gray-500 text-sm">Laporkan *bug*, *error*, atau kendala teknis pada Portal Tanjungmekar ke Admin.</p>
                        </div>
                    </div>
                    
                    <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Laporan kendala sistem telah diteruskan ke tim pengembang (IT). Terima kasih!'); window.location.href='{{ route('dashboard') }}';">
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kendala</label>
                            <select class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B] focus:ring-opacity-50 py-3" required>
                                <option value="">-- Pilih Jenis Kendala --</option>
                                <option value="peta">Peta Tidak Muncul / Error</option>
                                <option value="login">Masalah Login / Akun</option>
                                <option value="ui">Tampilan Berantakan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Error</label>
                            <textarea rows="5" placeholder="Jelaskan di halaman mana error terjadi dan apa yang Anda lihat..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B] focus:ring-opacity-50" required></textarea>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ url('/') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition-colors">Batal</a>
                            <button type="submit" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-md transition-colors">Kirim Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>