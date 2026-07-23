<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Mail;
use App\Mail\FaqUserStatusMail;

class FaqAdminController extends Controller
{
    // === BAGIAN FAQ WARGA ===

    public function index()
    {
        // Proteksi super ketat. Hanya menampilkan pengajuan yang BUKAN bawaan web 
        // dan menghindari FAQ yang diinput manual oleh nama penanya "Sistem Web"
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
            'jawaban' => 'required|string',
            'status' => 'required|in:pending,dipublikasi,ditolak',
            'action_button_text' => 'nullable|string|max:50',
            'action_link' => 'nullable|string',
        ]);

        $faq = Faq::findOrFail($id);
        
        // Simpan status lama sebelum diupdate
        $oldStatus = strtolower($faq->status);

        $faq->update([
            'jawaban' => $request->jawaban,
            'status' => $request->status,
            'action_button_text' => $request->action_button_text,
            'action_link' => $request->action_link,
        ]);

        // Kirim email HANYA JIKA status SEBELUMNYA 'pending' DAN status BARU BUKAN 'pending'
        // Jadi kalau diedit lagi dari dipublikasi ke ditolak (atau sebaliknya), email gak bakal dikirim lagi.
        if ($oldStatus === 'pending' && strtolower($request->status) !== 'pending' && $faq->email_penanya) {
            Mail::to($faq->email_penanya)->send(new FaqUserStatusMail($faq));
        }

        return back()->with('success', 'FAQ warga berhasil diulas!');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $oldStatus = strtolower($faq->status);

        // LOGIKA SHORTCUT: Jika status belum ditolak, ubah jadi ditolak
        if ($oldStatus !== 'ditolak') {
            $faq->update(['status' => 'ditolak']);
            
            // Kirim email penolakan HANYA JIKA status awalnya dari 'pending'
            if ($oldStatus === 'pending' && $faq->email_penanya) {
                Mail::to($faq->email_penanya)->send(new FaqUserStatusMail($faq));
            }
            
            return back()->with('success', 'FAQ ditolak! Dipindahkan ke tab Ditolak.');
        }

        // LOGIKA PERMANEN: Jika status sudah ditolak (dihapus dari tab Ditolak), hapus beneran
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