<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <!-- Link Kembali diubah ke url('/') -->
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Pusat Bantuan & FAQ') }}
            </h2>
        </div>
    </x-slot>

    <!-- Alpine.js dipasang di root sini buat fitur pencarian -->
    <div class="py-8 md:py-12 bg-gray-50 min-h-screen" x-data="faqSearch()">
        <!-- Tambahan px-4 di sini biar ada jarak aman di layar mobile -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- HEADER PENCARIAN (Sudah Disesuaikan Proporsinya Untuk Mobile & Desktop) -->
            <div class="bg-[#0E4D2B] rounded-2xl md:rounded-3xl px-6 py-8 md:p-10 mb-8 md:mb-10 text-center shadow-lg relative overflow-hidden">
                <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-2 md:mb-3 relative z-10 leading-tight">Halo {{ Auth::user()->name }}, ada yang bisa kami bantu?</h3>
                <p class="text-sm md:text-base text-[#A5D6A7] font-medium mb-6 relative z-10 px-2 md:px-0">Ketik kata kunci pertanyaan atau kendala Anda di bawah ini.</p>
                <div class="max-w-2xl mx-auto relative z-10">
                    <input type="text" x-model="searchQuery" placeholder="Contoh: Jadwal operasional, cara daftar..." class="w-full pl-11 md:pl-12 pr-4 py-3.5 md:py-4 rounded-xl border-none shadow-sm focus:ring-4 focus:ring-green-300 text-sm md:text-base font-medium text-gray-700">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-gray-400 absolute left-4 top-3.5 md:top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <!-- LIST FAQ DINAMIS DENGAN FITUR FILTER ALPINE -->
            <div class="space-y-4">
                @forelse($faqs->sortBy('pertanyaan') as $faq)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6 faq-item" 
                     data-question="{{ strtolower($faq->pertanyaan) }}" 
                     x-show="searchQuery === '' || '{{ strtolower($faq->pertanyaan) }}'.includes(searchQuery.toLowerCase())">
                    <h4 class="text-base md:text-lg font-bold text-[#0E4D2B] mb-2 leading-snug">{{ $faq->pertanyaan }}</h4>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">{{ $faq->jawaban }}</p>
                    
                    @if($faq->action_link && $faq->action_button_text)
                    <div class="mt-4 md:mt-5">
                        <a href="{{ url($faq->action_link) }}" class="inline-block px-5 py-2.5 bg-[#0E4D2B] text-white text-xs md:text-sm font-bold rounded-lg hover:bg-[#0A3D22] transition shadow-sm">
                            {{ $faq->action_button_text }}
                        </a>
                    </div>
                    @endif
                </div>
                @empty
                <!-- Ini nggak bakal kepanggil kalau faqs kosong dari backend, tapi jaga-jaga aja -->
                @endforelse

                <!-- KOTAK KUNING: MUNCUL KALAU KETIKAN GAK ADA DI DAFTAR -->
                <div x-show="searchQuery !== '' && !hasResults()" style="display: none;" class="bg-yellow-50 p-6 md:p-8 text-center rounded-2xl border-2 border-yellow-400 shadow-sm mt-8">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-lg md:text-xl font-bold text-gray-800 mb-2">Pertanyaan Tidak Ditemukan</h4>
                    <p class="text-sm md:text-base text-gray-600 mb-6 px-2">Kami tidak dapat menemukan pertanyaan untuk kalimat "<span class="font-bold" x-text="searchQuery"></span>". Silakan ajukan pertanyaan baru kepada kami.</p>
                    <a href="{{ route('faq.tambah') }}" class="inline-flex items-center gap-2 px-5 md:px-6 py-2.5 md:py-3 bg-[#FBC02D] text-[#0E4D2B] text-sm md:text-base font-bold rounded-xl shadow-md hover:bg-yellow-500 transition">
                        Buat Pengajuan Pertanyaan Baru
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- BAGIAN BAWAH DEFAULT -->
            <div x-show="searchQuery === ''" class="mt-10 md:mt-12 text-center">
                <p class="text-sm md:text-base text-gray-500 mb-4">Tidak menemukan pertanyaan yang Anda cari?</p>
                <a href="{{ route('faq.tambah') }}" class="inline-flex items-center gap-2 px-6 md:px-8 py-2.5 md:py-3 bg-[#0E4D2B] text-white text-sm md:text-base font-bold rounded-xl shadow-md hover:bg-[#0A3D22] transition">
                    Buat Pengajuan Pertanyaan Baru
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

        </div>
    </div>

    <!-- Script Alpine.js buat nyari kotak yang sesuai -->
    <script>
        function faqSearch() {
            return {
                searchQuery: '',
                hasResults() {
                    if (this.searchQuery === '') return true;
                    let items = document.querySelectorAll('.faq-item');
                    let query = this.searchQuery.toLowerCase();
                    let found = false;
                    items.forEach(item => {
                        let text = item.getAttribute('data-question');
                        if (text.includes(query)) {
                            found = true;
                        }
                    });
                    return found;
                }
            }
        }
    </script>
</x-app-layout>