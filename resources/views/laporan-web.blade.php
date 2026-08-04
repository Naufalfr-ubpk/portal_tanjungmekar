<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
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
                    

                    @if(session('success'))
                    <div x-data="{ showModal: true }" x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4" style="display: none;">
                        <div @click.away="showModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 text-center transform transition-all">
                            <div class="w-16 h-16 bg-[#e8f5e9] text-[#2E7D32] border border-[#A5D6A7] rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Terkirim!</h3>
                            <p class="text-sm text-gray-600 mb-6">{{ session('success') }}</p>
                            <button @click="showModal = false" class="w-full bg-[#0E4D2B] hover:bg-[#2E7D32] text-white font-bold py-3 rounded-xl transition shadow-sm">Oke, Mengerti</button>
                        </div>
                    </div>
                    @endif


                    <form action="{{ route('laporan-web.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kendala</label>
                            <select name="jenis_kendala" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B] focus:ring-opacity-50 py-3" required>
                                <option value="" disabled selected hidden>-- Pilih Jenis Kendala --</option>
                                
                                <option value="Error">Error</option>
                                <option value="Bug">Bug</option>
                                <option value="UI">Masalah Tampilan</option>
                                <option value="Lainnya">Lainnya</option>

                            </select>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Error</label>
                            <textarea name="deskripsi" rows="5" placeholder="Jelaskan di halaman mana error terjadi dan apa yang Anda lihat..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B] focus:ring-opacity-50" required></textarea>
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