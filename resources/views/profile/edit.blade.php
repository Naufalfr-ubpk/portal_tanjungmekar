<x-app-layout>
    <x-slot name="header">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
        
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
                <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-2 pl-4 border-gray-300">
                {{ __('Profil Saya') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6" x-data="avatarUploadSystem()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex items-center gap-6 relative">
                

                <div class="flex flex-col items-center gap-3">
                    <div class="relative w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden border-4 border-[#0E4D2B] group">
                        <img id="current-avatar" src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background=A5D6A7&bold=true';">
                        
                        @if(Auth::user()->password != null)
                            <label for="avatar_upload" class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer cursor">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-[10px] font-bold">UBAH</span>
                                <input type="file" id="avatar_upload" class="hidden" accept="image/png, image/jpeg, image/jpg" @change="selectFile">
                            </label>
                        @endif
                    </div>
                    
                    @if(Auth::user()->avatar && !str_contains(Auth::user()->avatar, 'ui-avatars.com') && !str_contains(Auth::user()->avatar, 'googleusercontent.com'))
                        <form method="POST" action="{{ route('profile.avatar.delete') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 hover:underline transition">Hapus Foto</button>
                        </form>
                    @endif
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-block px-3 py-1 bg-[#A5D6A7] text-[#0E4D2B] text-xs font-bold rounded-full uppercase tracking-wider">
                            Akun {{ Auth::user()->role ?? 'Warga' }}
                        </span>
                        @if(Auth::user()->password == null)
                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-600 border border-gray-300 text-xs font-bold rounded-full flex items-center gap-1">
                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.761H12.545z"/></svg>
                                Google
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

           @if(Auth::user()->password != null)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            @endif

            @if(Auth::user()->password != null && Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
            
        </div>

        <div x-show="openModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4 overflow-hidden">
            <div @click.away="closeModal()" class="bg-white rounded-2xl shadow-2xl max-w-xl w-full p-6 relative flex flex-col max-h-[90vh]">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-[#0E4D2B]">Sesuaikan Foto Profil</h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="w-full bg-gray-100 rounded-xl overflow-hidden flex-grow flex items-center justify-center border-2 border-dashed border-gray-300 mb-4" style="min-height: 300px; max-height: 400px;">
                    <img id="image-workspace" src="" class="max-w-full max-h-full">
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <button type="button" @click="rotateImage()" class="flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition border border-gray-300 w-full sm:w-auto justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Putar 90°
                    </button>

                    <div class="flex gap-3 w-full sm:w-auto">
                        <button type="button" @click="closeModal()" class="flex-1 sm:flex-none px-5 py-2.5 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="button" @click="saveCrop()" class="flex-1 sm:flex-none px-5 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg hover:bg-[#2E7D32] transition shadow-md flex items-center justify-center gap-2" :disabled="isUploading">
                            <span x-show="!isUploading">Simpan Foto</span>
                            <span x-show="isUploading">Menyimpan...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function avatarUploadSystem() {
            return {
                openModal: false,
                cropper: null,
                isUploading: false,
                
                selectFile(event) {
                    let file = event.target.files[0];
                    if (!file) return;

                    // Pastikan file adalah gambar
                    if (!file.type.match('image.*')) {
                        alert("Harap pilih file gambar (JPG/PNG).");
                        return;
                    }

                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.openModal = true;
                        
                        // Set gambar ke workspace
                        let image = document.getElementById('image-workspace');
                        image.src = e.target.result;

                        // Hancurkan cropper lama kalau ada, lalu bikin baru
                        if (this.cropper) {
                            this.cropper.destroy();
                        }

                        // Jeda bentar nunggu modal render
                        setTimeout(() => {
                            this.cropper = new Cropper(image, {
                                aspectRatio: 1, // Pasti kotak (1:1) buat foto profil
                                viewMode: 1,
                                dragMode: 'move',
                                autoCropArea: 0.9,
                                restore: false,
                                guides: true,
                                center: true,
                                highlight: false,
                                cropBoxMovable: true,
                                cropBoxResizable: true,
                                toggleDragModeOnDblclick: false,
                            });
                        }, 100);
                    };
                    reader.readAsDataURL(file);
                    event.target.value = ''; // Reset input
                },

                rotateImage() {
                    if(this.cropper) {
                        this.cropper.rotate(90);
                    }
                },

                closeModal() {
                    this.openModal = false;
                    if(this.cropper) {
                        this.cropper.destroy();
                        this.cropper = null;
                    }
                },

                saveCrop() {
                    if (!this.cropper) return;
                    this.isUploading = true;

                    // Ambil hasil crop dalam bentuk Base64 (resolusi 500x500 biar enteng)
                    let canvas = this.cropper.getCroppedCanvas({
                        width: 500,
                        height: 500,
                    });
                    
                    let base64data = canvas.toDataURL('image/png');

                    // Kirim ke Controller via AJAX
                    fetch("{{ route('profile.avatar.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ avatar: base64data })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            // Langsung refresh halaman biar sinkron sama database & tombol Hapus muncul!
                            window.location.reload();
                        } else {
                            alert('Gagal mengupload gambar.');
                            this.isUploading = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan pada server.');
                        this.isUploading = false;
                    });
                }
            }
        }
    </script>
</x-app-layout>