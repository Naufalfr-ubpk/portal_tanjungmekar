<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqAdminController extends Controller
{
    // === BAGIAN FAQ WARGA ===
    public function index()
    {
        $faqs = Faq::where(function($query) {
            $query->whereNull('is_bawaan')
                  ->orWhere('is_bawaan', 0)
                  ->orWhere('is_bawaan', false)
                  ->orWhere('is_bawaan', '0');
        })->where('nama_penanya', '!=', 'Sistem Web')->latest()->get();
        
        return view('admin.faq.index', compact('faqs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required_unless:status,ditolak|nullable|string',
            'status' => 'required|in:pending,dipublikasi,ditolak',
            'action_button_text' => 'nullable|string|max:50',
            'action_link' => 'nullable|string',
        ]);

        // Langsung update tanpa ngirim email apa-apa
        Faq::findOrFail($id)->update([
            'jawaban' => $request->jawaban,
            'status' => $request->status,
            'action_button_text' => $request->action_button_text,
            'action_link' => $request->action_link,
        ]);

        return back()->with('success', 'Pengajuan FAQ berhasil diulas!');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $oldStatus = strtolower($faq->status);

        // Jika status BUKAN ditolak -> Pindahkan ke Tab Ditolak (Tanpa Email)
        if ($oldStatus !== 'ditolak') {
            $faq->update(['status' => 'ditolak']);
            return back()->with('success', 'FAQ ditolak! Dipindahkan ke tab Ditolak.');
        }

        // Jika SUDAH di Tab Ditolak -> Hapus Permanen
        $faq->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus secara permanen.');
    }

    // === BAGIAN FAQ BAWAAN WEB ===
    public function bawaanIndex()
    {
        $faqs = Faq::where('is_bawaan', true)->orWhere('is_bawaan', 1)->latest()->get();
        return view('admin.faq.bawaan', compact('faqs'));
    }

    public function bawaanStore(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
            'action_button_text' => 'nullable|string|max:50',
            'action_link' => 'nullable|string',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'status' => 'dipublikasi',
            'is_bawaan' => true,
            'nama_penanya' => 'Sistem Web',
            'action_button_text' => $request->action_button_text,
            'action_link' => $request->action_link,
        ]);

        return back()->with('success', 'FAQ Bawaan berhasil ditambahkan!');
    }

    public function bawaanUpdate(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
            'action_button_text' => 'nullable|string|max:50',
            'action_link' => 'nullable|string',
        ]);

        Faq::findOrFail($id)->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'action_button_text' => $request->action_button_text,
            'action_link' => $request->action_link,
        ]);

        return back()->with('success', 'FAQ Bawaan berhasil diperbarui!');
    }

    public function bawaanDestroy($id)
    {
        Faq::findOrFail($id)->delete();
        return back()->with('success', 'FAQ Bawaan berhasil dihapus.');
    }
}