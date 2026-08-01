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


                <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-transparent hover:border-[#FBC02D] hover:shadow-lg transition-all relative overflow-hidden group">
                        <!-- Aksen Kuning di Pojok -->
                        <div class="absolute top-0 right-0 w-24 h-24 bg-[#FBC02D] opacity-10 rounded-bl-full transform translate-x-8 -translate-y-8 group-hover:scale-110 transition-transform"></div>
                        
                        <div class="w-12 h-12 bg-yellow-100 text-[#F59E0B] rounded-xl flex items-center justify-center mb-4 relative z-10 border border-yellow-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2 relative z-10">Bank Sampah Digital</h4>
                        <p class="text-sm text-gray-600 mb-6 relative z-10">Sistem monitoring terpadu untuk pencatatan tabungan sampah dan saldo rupiah milik warga.</p>
                        
                        <a href="{{ route('user.bank-sampah') }}" class="block w-full bg-[#FBC02D] hover:bg-yellow-500 text-[#0E4D2B] text-center font-bold py-3 px-4 rounded-xl transition-colors relative z-10 shadow-sm">
                            Buka Bank Sampah
                        </a>
                    </div>

            </div>
        </div>
    </div>
</x-app-layout>