<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Pusat Bantuan & FAQ') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" x-data="faqSystem()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-[#0E4D2B] rounded-2xl shadow-lg p-8 mb-8 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                <div class="relative z-10 text-center">
                    <h3 class="text-2xl font-bold text-white mb-2">Halo {{ Auth::user()->name }}, ada yang bisa kami bantu?</h3>
                    <p class="text-[#A5D6A7] text-sm mb-6">Ketik kata kunci pertanyaan atau kendala Anda di bawah ini.</p>
                    
                    <div class="relative max-w-2xl mx-auto flex items-center">
                        <svg class="w-6 h-6 text-gray-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input x-model="searchQuery" type="text" placeholder="Contoh: Jadwal operasional, cara daftar, jenis sampah..." class="w-full pl-12 pr-4 py-4 rounded-xl border-none text-gray-900 focus:ring-4 focus:ring-[#FBC02D] shadow-inner text-lg">
                    </div>
                </div>
            </div>

            <div class="space-y-4" x-show="filteredFaqs.length > 0">
                <template x-for="(faq, index) in filteredFaqs" :key="index">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-[#A5D6A7] transition-colors">
                        <h4 class="text-lg font-bold text-[#0E4D2B]" x-text="faq.question"></h4>
                        <p class="text-gray-600 mt-2 text-sm leading-relaxed" x-text="faq.answer"></p>
                    </div>
                </template>
            </div>

            <div x-show="searchQuery !== '' && filteredFaqs.length === 0" style="display: none;" class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center mt-6">
                <h4 class="text-xl font-bold text-gray-800 mb-2">Pertanyaan Tidak Ditemukan</h4>
                <p class="text-gray-500 mb-6">Kami tidak menemukan jawaban untuk pencarian Anda. Jangan khawatir, Anda dapat langsung mengajukan pertanyaan ini ke sistem.</p>
                <a href="{{ route('faq.tambah') }}" class="inline-block bg-[#FBC02D] hover:bg-yellow-500 text-[#0E4D2B] font-bold py-3 px-8 rounded-full shadow transition-all">
                    Ajukan Pertanyaan Sekarang
                </a>
            </div>

            <div x-show="filteredFaqs.length > 0" class="mt-12 text-center border-t border-gray-200 pt-8">
                <p class="text-gray-500 mb-4 font-medium">Tidak menemukan jawaban yang sesuai di daftar atas?</p>
                <a href="{{ route('faq.tambah') }}" class="inline-flex items-center bg-white border-2 border-[#0E4D2B] hover:bg-[#0E4D2B] hover:text-white text-[#0E4D2B] font-bold py-3 px-6 rounded-lg transition-all group shadow-sm">
                    Buat Pengajuan Pertanyaan Baru
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

        </div>
    </div>

    <script>
        function faqSystem() {
            return {
                searchQuery: '',
                faqs: [
                    { question: 'Bagaimana cara mendaftar akun di Portal Tanjungmekar?', answer: 'Klik tombol Sign Up di pojok kanan atas. Anda bisa mendaftar dengan mengetikkan email dan password secara manual, atau menggunakan akun Google.' },
                    { question: 'Apa saja jenis sampah yang diterima?', answer: 'Warga dapat membawa sampah non-organik (plastik, kardus) dan sampah organik tertentu yang telah dipilah ke lokasi.' },
                    { question: 'Apakah data pribadi saya aman?', answer: 'Sangat aman. Sistem kami dilengkapi enkripsi password dan privasi ketat.' },
                    { question: 'Bagaimana melihat lokasi terdekat?', answer: 'Gunakan menu Peta Wilayah dan klik tombol Temukan Lokasi Saya.' },
                    { question: 'Kapan jadwal operasional Bank Sampah?', answer: 'Operasional Bank Sampah (RW 04) buka setiap hari Sabtu dan Minggu pukul 08.00 - 12.00 WIB. Untuk titik RW lainnya, silakan datang ke Posko masing-masing pada menu Peta.' },
                    { question: 'Bagaimana jika saya lupa password?', answer: 'Jika Anda mendaftar menggunakan email biasa, klik menu "Lupa Password" di halaman Login. Jika Anda mendaftar menggunakan Google, Anda cukup login kembali menggunakan tombol Google.' }
                ],
                get filteredFaqs() {
                    if (this.searchQuery === '') return this.faqs;
                    return this.faqs.filter(faq => faq.question.toLowerCase().includes(this.searchQuery.toLowerCase()) || faq.answer.toLowerCase().includes(this.searchQuery.toLowerCase()));
                }
            }
        }
    </script>
</x-app-layout>