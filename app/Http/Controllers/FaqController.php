<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FaqNotificationMail;

class FaqController extends Controller
{
    public function index()
    {
        // FILTER KETAT: Menyinkronkan murni dengan apa yang ada di Panel Admin
        // Mengabaikan "data hantu" sisa tes sebelumnya.
        $faqs = Faq::whereIn('status', ['dipublikasi', 'Dipublikasi'])
            ->where(function($query) {
                // 1. Ambil FAQ Bawaan Web yang valid (Sama persis kayak filter Admin Kelola Web)
                $query->where('is_bawaan', 1)
                      ->orWhere('is_bawaan', true)
                      ->orWhere('is_bawaan', '1')
                // 2. ATAU Ambil FAQ Warga yang valid (Sama persis kayak filter Admin Daftar Warga)
                      ->orWhere(function($subQuery) {
                          $subQuery->where(function($q) {
                              $q->whereNull('is_bawaan')
                                ->orWhere('is_bawaan', 0)
                                ->orWhere('is_bawaan', false)
                                ->orWhere('is_bawaan', '0');
                          })->where('nama_penanya', '!=', 'Sistem Web');
                      });
            })
            ->orderBy('pertanyaan', 'asc') // Urut abjad A-Z otomatis dari database
            ->get();

        return view('faq', compact('faqs'));
    }

    public function create()
    {
        return view('tambah-faq');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'detail_pertanyaan' => 'nullable|string',
        ]);

        $faq = Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'detail_pertanyaan' => $request->detail_pertanyaan,
            'nama_penanya' => Auth::user()->name,
            'email_penanya' => Auth::user()->email,
            'status' => 'pending', 
            'is_bawaan' => false,
        ]);

        $adminEmail = 'gr1mmp4ck@gmail.com'; 
        $operatorEmail = 'pakaji08432@gmail.com'; // Email Google Asli Pak Aji

        // 1. Kirim ke Operator (dengan BCC ke Admin agar Admin dapat salinan pantauan)
        Mail::to($operatorEmail)
            ->bcc($adminEmail)
            ->send(new FaqNotificationMail($faq, 'Operator', false));
            
        // 2. Kirim pesan utama khusus ke Admin
        Mail::to($adminEmail)->send(new FaqNotificationMail($faq, 'Admin', false));

        return back()->with('success', 'Pertanyaan Anda berhasil diajukan dan sedang menunggu ulasan.');
    }
}