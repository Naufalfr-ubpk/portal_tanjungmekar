<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                    <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            <span class="text-xs font-bold bg-[#0E4D2B] text-white px-3 py-1 rounded-full uppercase tracking-wider">Akun Warga</span>
        </div>
    </x-slot>

    <div class="py-12 bg-[#F4F8F4] min-h-[calc(100vh-5rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-l-8 border-[#FBC02D] p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="text-2xl font-extrabold text-[#0E4D2B]">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-600 mt-1">Anda masuk menggunakan email <span class="font-semibold text-gray-800">{{ Auth::user()->email }}</span>.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div>
                        <div class="w-12 h-12 bg-[#A5D6A7] rounded-xl flex items-center justify-center text-[#0E4D2B] mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-1">Pemetaan Wilayah</h4>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Cari tahu informasi letak Kantor Kelurahan, kepengurusan RW, dan Bank Sampah.</p>
                    </div>
                    <a href="{{ route('pemetaan') }}" class="w-full text-center bg-[#0E4D2B] hover:bg-[#2E7D32] text-white font-bold py-2 px-4 rounded-lg text-sm transition-colors block">Buka Peta Wilayah</a>
                </div>


                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between border-b-4 border-dashed border-gray-300 opacity-80">
                <div>
                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-400 mb-1">Bank Sampah Digital</h4>
                    <p class="text-xs text-gray-400 mb-4 leading-relaxed">Sistem monitoring terpadu untuk pencatatan tabungan sampah dan saldo rupiah milik warga.</p>
                </div>
                <span class="w-full text-center bg-gray-100 text-gray-400 font-bold py-2 px-4 rounded-lg text-sm cursor-not-allowed block">Fitur Belum Rilis</span>
            </div>


            </div>
        </div>
    </div>
</x-app-layout>