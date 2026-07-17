<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-[#0E4D2B] leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Peta Wilayah Tanjungmekar') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F4F8F4] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row gap-8 items-start relative">
                
                <div class="w-full lg:w-1/3 flex flex-col gap-6">
                    
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200 text-center">
                        <button onclick="lokasiSaya()" class="w-full flex items-center justify-center gap-2 bg-[#0E4D2B] hover:bg-[#2E7D32] text-white font-bold py-3 px-4 rounded-xl shadow transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            Lokasi Saya
                        </button>
                        <div id="alamat-user" class="text-xs text-gray-700 mt-4 font-medium px-2 italic text-left leading-relaxed border-t border-gray-100 pt-3 hidden">
                            Mendeteksi lokasi...
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-extrabold text-[#0E4D2B] uppercase tracking-widest mb-3 border-b-2 border-gray-300 pb-1">Area Kelurahan</h4>
                        <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#0E4D2B] overflow-hidden">
                            <div class="p-5 cursor-pointer hover:bg-gray-50" onclick="fokusPeta(-6.2842, 107.2884)">
                                <h5 class="font-bold text-gray-800 text-lg">Kantor Kelurahan Tanjungmekar</h5>
                                <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Lurah:</span> Bapak Aji</p>
                                <p class="text-xs text-gray-500 mt-1 mb-2">Resepsionis: 0812-XXXX-XXXX</p>
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-xs text-gray-500 leading-relaxed"><span class="font-bold text-[#0E4D2B]">Detail Lokasi:</span> Jl. Raya Tanjungmekar No.1, Karawang Barat, Jawa Barat</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-end">
                                <a href="https://maps.google.com/?q=-6.2842,107.2884" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                    Buka di Google Maps <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-extrabold text-yellow-600 uppercase tracking-widest mb-3 border-b-2 border-gray-300 pb-1">Bank Sampah</h4>
                        <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#FBC02D] overflow-hidden">
                            <div class="p-5 cursor-pointer hover:bg-gray-50" onclick="fokusPeta(-6.2855, 107.2890)">
                                <h5 class="font-bold text-gray-800 text-lg">Bank Sampah (RW 04)</h5>
                                <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Pengelola:</span> Kang Yana</p>
                                <p class="text-xs text-gray-500 mt-1 mb-2">Kontak: 0857-XXXX-XXXX</p>
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-xs text-gray-500 leading-relaxed"><span class="font-bold text-[#0E4D2B]">Detail Lokasi:</span> Posko Bank Sampah, Jl. Lingkungan RT 02, RW 04 Tanjungmekar</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-end">
                                <a href="https://maps.google.com/?q=-6.2855,107.2890" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                    Buka di Google Maps <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-extrabold text-[#66BB6A] uppercase tracking-widest mb-3 border-b-2 border-gray-300 pb-1">Rukun Warga (RW)</h4>
                        <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#66BB6A] overflow-hidden">
                            <div class="p-5 cursor-pointer hover:bg-gray-50" onclick="fokusPeta(-6.2860, 107.2900)">
                                <h5 class="font-bold text-gray-800 text-lg">RW 01</h5>
                                <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Ketua RW:</span> Bapak Budi</p>
                                <p class="text-xs text-gray-500 mt-1 mb-2">Kontak: 0811-XXXX-XXXX</p>
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-xs text-gray-500 leading-relaxed"><span class="font-bold text-[#0E4D2B]">Detail Lokasi:</span> Pos Keamanan RW 01, Jalan Pangkalan Perjuangan</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-end">
                                <a href="https://maps.google.com/?q=-6.2860,107.2900" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                    Buka di Google Maps <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

<!----- <div class="w-full lg:w-2/3 sticky top-15 z-10"> ----->
                    <div class="w-full lg:w-2/3 sticky top-[60px] z-10">
                    <div class="bg-white p-2 rounded-2xl shadow-sm border-2 border-gray-200">
                        <div id="map" class="w-full h-[450px] rounded-xl relative z-0"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([-6.284241, 107.288424], 15);
        var userMarker = null;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap | KKN UBP Karawang 2026'
        }).addTo(map);

        var greenIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34]
        });

        var blueDotIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34]
        });

        let markersData = [
            {lat: -6.2842, lng: 107.2884, title: "Kantor Kelurahan Tanjungmekar"},
            {lat: -6.2855, lng: 107.2890, title: "Bank Sampah (RW 04)"},
            {lat: -6.2860, lng: 107.2900, title: "RW 01"}
        ];

        markersData.forEach(loc => {
            L.marker([loc.lat, loc.lng], {icon: greenIcon}).addTo(map).bindPopup(`<b class='text-[#0E4D2B] text-sm'>${loc.title}</b>`);
        });

        function fokusPeta(lat, lng) {
            map.flyTo([lat, lng], 17, { animate: true, duration: 1.5 });
        }

        document.addEventListener('DOMContentLoaded', () => {
            let savedLat = localStorage.getItem('kkn_lat');
            let savedLng = localStorage.getItem('kkn_lng');
            let savedAddr = localStorage.getItem('kkn_addr');

            if(savedLat && savedLng && savedAddr) {
                let addrBox = document.getElementById('alamat-user');
                addrBox.style.display = "block";
                addrBox.innerHTML = `<span class='text-green-700 font-bold'>Detail Lokasi Anda:</span><br> ${savedAddr}`;
                
                userMarker = L.marker([savedLat, savedLng], {icon: blueDotIcon}).addTo(map)
                    .bindPopup("<b class='text-blue-600'>Lokasi Anda</b>").openPopup();
                
                map.setView([savedLat, savedLng], 16);
            }
        });

        function lokasiSaya() {
            let addrBox = document.getElementById('alamat-user');
            addrBox.style.display = "block";
            addrBox.innerText = "Mendeteksi lokasi dengan akurasi tinggi...";
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    
                    if (userMarker) map.removeLayer(userMarker);
                    userMarker = L.marker([lat, lng], {icon: blueDotIcon}).addTo(map)
                        .bindPopup("<b class='text-blue-600'>Lokasi Anda Saat Ini</b>").openPopup();
                    
                    map.flyTo([lat, lng], 17, { animate: true, duration: 1.5 });

                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                        .then(response => response.json())
                        .then(data => {
                            // REVISI: Tarik alamat komplit bawaan API OSM
                            let fullAddress = data.display_name; 
                            
                            addrBox.innerHTML = `<span class='text-green-700 font-bold'>Detail Lokasi Anda:</span><br> ${fullAddress}`;
                            localStorage.setItem('kkn_lat', lat);
                            localStorage.setItem('kkn_lng', lng);
                            localStorage.setItem('kkn_addr', fullAddress);
                        })

                        .catch(() => {
                            addrBox.innerText = "Gagal memuat nama jalan detail, namun titik peta sudah akurat.";
                        });
                        
                }, function(error) {
                    addrBox.innerText = "Akses lokasi ditolak atau GPS tidak merespon.";
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                addrBox.innerText = "Browser tidak mendukung GPS.";
            }
        }

// BIKIN TOMBOL KEMBALI KE LOKASI (WARNA HIJAU) DI BAWAH TOMBOL ZOOM
        var targetControl = L.Control.extend({
            options: { position: 'topleft' },
            onAdd: function (map) {
                var btn = L.DomUtil.create('button', 'leaflet-bar leaflet-control');
                // Icon Target / Crosshair
                btn.innerHTML = `<svg style="width:20px;height:20px;margin:auto;color:white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3"></path></svg>`;
                btn.style.backgroundColor = '#0E4D2B';
                btn.style.width = '34px';
                btn.style.height = '34px';
                btn.style.display = 'flex';
                btn.style.cursor = 'pointer';
                btn.style.border = '2px solid rgba(0,0,0,0.2)';
                btn.title = "Kembali ke Titik Anda";

                btn.onclick = function(e){
                    e.preventDefault();
                    let savedLat = localStorage.getItem('kkn_lat');
                    let savedLng = localStorage.getItem('kkn_lng');
                    if(savedLat && savedLng) {
                        // Terbang balik ke lokasi terakhir tanpa loading ulang GPS
                        map.flyTo([savedLat, savedLng], 17, { animate: true, duration: 1.5 });
                    } else {
                        alert('Klik tombol "Lokasi Saya" (hijau tua) terlebih dahulu untuk mendeteksi posisi Anda.');
                    }
                }
                return btn;
            }
        });
        map.addControl(new targetControl());

    </script>
</x-app-layout>