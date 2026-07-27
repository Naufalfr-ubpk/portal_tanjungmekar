<tr class="hover:bg-gray-50 transition">
    <td class="px-6 py-4">
        <div class="font-bold text-gray-800">{{ $faq->nama_penanya }}</div>
        <div class="text-xs text-gray-500 mt-1">{{ $faq->created_at->diffForHumans() }}</div>
    </td>
    <td class="px-6 py-4">
        <div class="font-bold text-[#0E4D2B] mb-1">{{ $faq->pertanyaan }}</div>
        <div class="text-xs text-gray-600 line-clamp-2 italic">"{{ $faq->detail_pertanyaan ?? 'Tidak ada detail.' }}"</div>
    </td>
    <td class="px-6 py-4">
        <span class="inline-block px-3 py-1 mb-1 text-[10px] font-bold rounded-full 
            {{ $faq->status == 'dipublikasi' ? 'bg-green-100 text-green-700' : ($faq->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }} uppercase">
            {{ $faq->status }}
        </span>
        <br>
        <span class="text-xs font-semibold text-gray-500">
            @if($faq->status === 'pending') Belum dijawab
            @elseif($faq->status === 'dipublikasi') Sudah disetujui
            @else Tidak disetujui
            @endif
        </span>
    </td>
    <td class="px-6 py-4 flex justify-center gap-2">
        <button @click="openModal({{ json_encode($faq) }})" class="bg-[#0E4D2B] hover:bg-[#0A3D22] text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm">Ulas & Jawab</button>
        <button @click="openDeleteModal('{{ route('admin.faq.destroy', $faq->id) }}', '{{ strtolower($faq->status) }}')" class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-lg shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </button>
    </td>
</tr>