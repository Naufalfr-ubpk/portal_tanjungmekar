<x-app-layout>



    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ (Auth::user()->role === 'admin' || Auth::user()->role === 'operator') ? url('/') : route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">



                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Bank Sampah Digital') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-6 bg-[#F4F8F4] min-h-screen">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            


           <!-- KARTU SALDO TOTAL -->
            <div class="bg-gradient-to-br from-[#0E4D2B] to-[#2E7D32] rounded-none md:rounded-3xl shadow-lg p-6 md:p-10 text-white flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
                <div class="z-20 relative text-left w-full md:w-auto">
                    <p class="text-[#A5D6A7] font-bold tracking-wider mb-2 uppercase text-xs md:text-sm flex items-center justify-start gap-2">
                        <svg class="w-5 h-5 text-[#FBC02D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Total Saldo Tabungan
                    </p>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-3">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h1>
                    <p class="text-xs sm:text-sm md:text-base text-gray-200 relative z-20">Kumpulkan terus sampah organik dan anorganikmu dan tukarkan menjadi saldo rupiah!</p>
                </div>
                <!-- Icon background (Kelihatan di Mobile & Web sekarang) -->
                <div class="absolute right-[-1.5rem] bottom-[-1.5rem] md:relative md:right-0 md:bottom-0 z-10 opacity-20 transform scale-110 md:scale-150 md:translate-x-8 pointer-events-none">
                    <svg class="w-36 h-36 md:w-48 md:h-48" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <!-- Efek Blur Dekorasi -->
                <div class="absolute -right-10 -top-10 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-[#FBC02D] opacity-10 rounded-full blur-2xl pointer-events-none"></div>
            </div>



                <div class="hidden md:block z-10 opacity-20 transform scale-150 translate-x-8">
                    <svg class="w-48 h-48" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <!-- Efek Blur Dekorasi -->
                <div class="absolute -right-10 -top-10 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl"></div>
                <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-[#FBC02D] opacity-10 rounded-full blur-2xl"></div>
            </div>

            <!-- TABEL RIWAYAT TRANSAKSI -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mt-8">
                <div class="p-6 border-b border-gray-200 bg-white flex items-center justify-between">
                    <h3 class="text-xl font-extrabold text-gray-900">Riwayat Setoran</h3>
                    <span class="bg-[#e8f5e9] text-[#2E7D32] text-xs font-bold px-3 py-1 rounded-full">{{ $transaksi->count() }} Transaksi</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                                <th class="px-6 py-4 font-bold">Tanggal</th>
                                <th class="px-6 py-4 font-bold">Kategori Sampah</th>
                                <th class="px-6 py-4 font-bold">Berat / Qty</th>
                                <th class="px-6 py-4 font-bold">Total Rupiah</th>
                                <th class="px-6 py-4 font-bold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($transaksi as $t)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">{{ \Carbon\Carbon::parse($t->tanggal_setor)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 font-bold text-[#0E4D2B]">{{ $t->kategoriSampah?->nama_kategori ?? 'Tidak Diketahui' }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                                        {{ floatval($t->berat_jumlah) }} {{ trim(preg_replace('/[0-9]+/', '', $t->kategoriSampah?->satuan ?? '')) }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-[#F59E0B]">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-[#e8f5e9] text-[#2E7D32] border border-[#A5D6A7] text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">Selesai</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                                        <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-200">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        </div>
                                        <p class="font-bold text-lg text-gray-500">Belum Ada Transaksi</p>
                                        <p class="text-sm mt-1">Ayo mulai tabung sampahmu di Bank Sampah terdekat!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>