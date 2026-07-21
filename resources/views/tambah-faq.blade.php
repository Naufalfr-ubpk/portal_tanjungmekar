<x-app-layout>
    <!-- Modal diberi ID untuk dimanipulasi Vanilla JS agar kebal z-index trap -->
    @if(session('success'))
    <div id="success-modal" class="fixed inset-0 z-[999999] flex items-center justify-center p-4">
        <!-- Background Overlay Hitam Terpisah -->
        <div class="fixed inset-0 bg-black bg-opacity-70" onclick="document.getElementById('success-modal').remove()"></div>
        
        <!-- Konten Modal -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full text-center relative z-50">
            <button onclick="document.getElementById('success-modal').remove()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner mt-4">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Berhasil Dikirim!</h3>
            <p class="text-gray-600 mb-8">{{ session('success') }}</p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('faq') }}" class="w-full py-3 bg-[#0E4D2B] text-white font-bold rounded-xl hover:bg-[#0A3D22] transition shadow-md">Kembali ke Pusat FAQ</a>
                <button onclick="document.getElementById('success-modal').remove()" type="button" class="w-full py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Tutup & Ajukan Lagi</button>
            </div>
        </div>
    </div>
    
    <!-- Script murni memindahkan node DOM modal ke luar x-app-layout menembus navbar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('success-modal');
            if (modal) {
                document.body.appendChild(modal);
            }
        });
    </script>
    @endif

    <x-slot name="header">
        <div class="flex items-center gap-4 relative z-10">
            <a href="{{ route('faq') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Pengajuan Pertanyaan Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative z-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-t-4 border-yellow-400">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-[#0E4D2B] mb-2">Formulir Pengajuan FAQ</h3>
                    <p class="text-gray-600 mb-8">Silakan tuliskan pertanyaan spesifik Anda. Pertanyaan yang relevan akan ditampilkan di halaman FAQ publik setelah ditinjau.</p>

                    <form action="{{ route('faq.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan Utama <span class="text-red-500">*</span></label>
                            <input type="text" name="pertanyaan" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B]" placeholder="Contoh: Bagaimana cara mengganti icon profil?">
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Penjelasan Detail (Opsional)</label>
                            <textarea name="detail_pertanyaan" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B]" placeholder="Berikan konteks atau detail keluhan agar kami mudah memberikan jawaban yang akurat..."></textarea>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('faq') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition">Batal</a>
                            <button type="submit" class="px-6 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg shadow hover:bg-[#0A3D22] transition">Kirim Pertanyaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>