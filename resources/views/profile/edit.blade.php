<x-app-layout>
    <x-slot name="header">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
        
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0E4D2B] transition-colors group">
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

                        @php
                            $rawAvatar = Auth::user()->avatar;
                            $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true';
                            $avatarUrl = $rawAvatar ? (str_starts_with($rawAvatar, 'http') ? $rawAvatar : asset($rawAvatar)) : $fallbackAvatar;
                        @endphp

                        <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(str_starts_with(Auth::user()->avatar, 'storage/') ? Auth::user()->avatar : 'storage/' . Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=0E4D2B&background=' . (Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7') . '&bold=true' }}" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=0E4D2B&background={{ Auth::user()->role === 'operator' ? 'FBC02D' : 'A5D6A7' }}&bold=true';" alt="Avatar" class="w-full h-full object-cover">
                        
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
                        <span class="inline-block px-2.5 py-1 bg-[#A5D6A7] text-[#0E4D2B] text-[10px] font-bold rounded-md uppercase tracking-wide">
                            AKUN {{ Auth::user()->role === 'user' ? 'USER' : Auth::user()->role }}
                        </span>
                        
                        @if(Auth::user()->google_id)
                            <span class="inline-flex items-center gap-1 bg-white border border-gray-300 text-gray-700 px-2.5 py-1 rounded-md text-[10px] font-bold tracking-wide shadow-sm">
                                <svg class="w-3 h-3" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                                GOOGLE
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

            @if(is_null(Auth::user()->google_id) && Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
            
        </div>

        <div x-show="openModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4 overflow-hidden">
            <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full p-6 relative flex flex-col max-h-[90vh]">
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
                        
                        <form id="avatar-form" action="{{ route('profile.avatar.update') }}" method="POST" class="m-0 flex-1 sm:flex-none">
                            @csrf
                            <input type="hidden" name="avatar" id="avatar-input">
                            <button type="button" @click="saveCrop()" class="w-full sm:w-auto px-5 py-2.5 bg-[#0E4D2B] text-white font-bold rounded-lg hover:bg-[#2E7D32] transition shadow-md flex items-center justify-center gap-2" :disabled="isUploading">
                                <span x-show="!isUploading">Simpan Foto</span>
                                <span x-show="isUploading">Menyimpan...</span>
                            </button>
                        </form>
                        
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

                    if (!file.type.match('image.*')) {
                        alert("Harap pilih file gambar (JPG/PNG).");
                        return;
                    }

                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.openModal = true;
                        
                        let image = document.getElementById('image-workspace');
                        image.src = e.target.result;

                        if (this.cropper) {
                            this.cropper.destroy();
                        }

                        setTimeout(() => {
                            let cropperInstance = new Cropper(image, {
                                aspectRatio: 1, 
                                viewMode: 1,
                                dragMode: 'move',
                                autoCropArea: 0.9,
                                guides: true,
                                center: true,
                                highlight: false,
                                cropBoxMovable: true,
                                cropBoxResizable: true,
                            });
                            this.cropper = cropperInstance;
                        }, 100);
                    };
                    reader.readAsDataURL(file);
                    event.target.value = ''; 
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

                    // Turunin resolusi canvas biar enteng pas di-upload
                    let canvas = this.cropper.getCroppedCanvas({
                        width: 500,
                        height: 500,
                    });
                    
                    let base64data = canvas.toDataURL('image/jpeg', 0.8);
                    document.getElementById('avatar-input').value = base64data;
                    document.getElementById('avatar-form').submit();
                }
            }
        }
    </script>
</x-app-layout>