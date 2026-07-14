<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('faq') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Pengajuan Pertanyaan Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-t-8 border-[#FBC02D]">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-[#0E4D2B] mb-2">Formulir Pengajuan FAQ</h3>
                    <p class="text-gray-500 mb-8">Silakan tuliskan pertanyaan spesifik Anda. Pertanyaan yang relevan akan ditampilkan di halaman FAQ publik setelah ditinjau.</p>
                    
                    <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Pertanyaan berhasil dikirim dan masuk ke antrean validasi Admin/Operator.'); window.location.href='{{ route('faq') }}';">
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan Utama</label>
                            <input type="text" placeholder="Tuliskan inti pertanyaan Anda di sini..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B] focus:ring-opacity-50 py-3" required>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Penjelasan Detail (Opsional)</label>
                            <textarea rows="5" placeholder="Berikan konteks atau detail keluhan agar kami mudah memberikan jawaban yang akurat..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0E4D2B] focus:ring focus:ring-[#0E4D2B] focus:ring-opacity-50"></textarea>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('faq') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition-colors">Batal</a>
                            <button type="submit" class="px-8 py-3 bg-[#0E4D2B] hover:bg-[#2E7D32] text-white font-bold rounded-lg shadow-md transition-colors">Kirim Pertanyaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>