<tr class="hover:bg-gray-50 transition">
    <td class="px-6 py-4">
        <div class="font-bold text-[#0E4D2B] text-base">{{ $loc->title }}</div>
        <span class="inline-block px-2 py-1 mt-1 text-[10px] font-bold rounded-full 
            {{ $loc->type == 'kelurahan' ? 'bg-blue-100 text-blue-700' : ($loc->type == 'banksampah' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }} uppercase">
            {{ $loc->type == 'rw' ? 'Rukun Warga (RW)' : ($loc->type == 'banksampah' ? 'Bank Sampah' : 'Kantor Kelurahan') }}
        </span>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm font-semibold text-gray-900">{{ $loc->manager_label }}: {{ $loc->manager_name }}</div>
        <div class="text-xs text-gray-500 mt-1">{{ $loc->contact_label }}: {{ $loc->contact_number ?? '-' }}</div>
    </td>
    <td class="px-6 py-4">
        <div class="text-xs font-mono text-gray-600 bg-gray-100 px-2 py-1 rounded inline-block border border-gray-200">{{ $loc->koordinat }}</div>
        @if($loc->gmaps_link)
            <div class="mt-2">
                <a href="{{ $loc->gmaps_link }}" target="_blank" class="text-xs text-blue-600 hover:underline font-semibold flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Buka di Google Map
                </a>
            </div>
        @endif
    </td>
    <td class="px-6 py-4 flex items-center justify-center gap-3">
        <button @click="openModal('edit', {{ json_encode($loc) }})" class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-lg transition shadow-sm" title="Edit Data">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </button>
        <button @click="openDeleteModal('{{ route('admin.pemetaan.destroy', $loc->id) }}')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition shadow-sm" title="Hapus Data">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </button>
    </td>
</tr>