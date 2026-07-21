<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Pusat Bantuan & FAQ') }}
            </h2>
        </div>
    </x-slot>

    <!-- Alpine.js dipasang di root sini buat fitur pencarian -->
    <div class="py-12 bg-gray-50 min-h-screen" x-data="faqSearch()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- HEADER PENCARIAN -->
            <div class="bg-[#0E4D2B] rounded-3xl p-10 mb-10 text-center shadow-lg relative overflow-hidden">
                <h3 class="text-3xl font-extrabold text-white mb-2 relative z-10">Halo {{ Auth::user()->name }}, ada yang bisa kami bantu?</h3>
                <p class="text-[#A5D6A7] font-medium mb-6 relative z-10">Ketik kata kunci pertanyaan atau kendala Anda di bawah ini.</p>
                <div class="max-w-2xl mx-auto relative z-10">
                    <input type="text" x-model="searchQuery" placeholder="Contoh: Jadwal operasional, cara daftar, jenis sampah..." class="w-full pl-12 pr-4 py-4 rounded-xl border-none shadow-sm focus:ring-4 focus:ring-green-300 font-medium text-gray-700">
                    <svg class="w-6 h-6 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <!-- LIST FAQ DINAMIS DENGAN FITUR FILTER ALPINE (Urut Abjad) -->
            <div class="space-y-4">
                @forelse($faqs->sortBy('pertanyaan') as $faq)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 faq-item" 
                     data-question="{{ strtolower($faq->pertanyaan) }}" 
                     x-show="searchQuery === '' || '{{ strtolower($faq->pertanyaan) }}'.includes(searchQuery.toLowerCase())">
                    <h4 class="text-lg font-bold text-[#0E4D2B] mb-2">{{ $faq->pertanyaan }}</h4>
                    <p class="text-gray-600 leading-relaxed">{{ $faq->jawaban }}</p>
                    
                    @if($faq->action_link && $faq->action_button_text)
                    <div class="mt-4">
                        <a href="{{ url($faq->action_link) }}" class="inline-block px-5 py-2.5 bg-[#0E4D2B] text-white text-sm font-bold rounded-lg hover:bg-[#0A3D22] transition shadow-sm">
                            {{ $faq->action_button_text }}
                        </a>
                    </div>
                    @endif
                </div>
                @empty
                <!-- Kosong -->
                @endforelse

                <!-- KOTAK KUNING: MUNCUL KALAU KETIKAN GAK ADA DI DAFTAR -->
                <div x-show="searchQuery !== '' && !hasResults()" style="display: none;" class="bg-yellow-50 p-8 text-center rounded-2xl border-2 border-yellow-400 shadow-sm mt-8">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Pertanyaan Tidak Ditemukan</h4>
                    <p class="text-gray-600 mb-6">Kami tidak dapat menemukan pertanyaan untuk kalimat "<span class="font-bold" x-text="searchQuery"></span>". Silakan ajukan pertanyaan baru kepada kami.</p>
                    <a href="{{ route('faq.tambah') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#FBC02D] text-[#0E4D2B] font-bold rounded-xl shadow-md hover:bg-yellow-500 transition">
                        Buat Pengajuan Pertanyaan Baru
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- BAGIAN BAWAH DEFAULT -->
            <div x-show="searchQuery === ''" class="mt-12 text-center">
                <p class="text-gray-500 mb-4">Tidak menemukan pertanyaan yang Anda cari?</p>
                <a href="{{ route('faq.tambah') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white border-2 border-[#0E4D2B] text-[#0E4D2B] font-bold rounded-xl hover:bg-green-50 transition">
                    Buat Pengajuan Pertanyaan Baru
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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