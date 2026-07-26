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
        $faqs = Faq::whereIn('status', ['dipublikasi', 'Dipublikasi'])
            ->where(function($query) {
                $query->where('is_bawaan', 1)
                      ->orWhere('is_bawaan', true)
                      ->orWhere('is_bawaan', '1')
                      ->orWhere(function($subQuery) {
                          $subQuery->where(function($q) {
                              $q->whereNull('is_bawaan')
                                ->orWhere('is_bawaan', 0)
                                ->orWhere('is_bawaan', false)
                                ->orWhere('is_bawaan', '0');
                          })->where('nama_penanya', '!=', 'Sistem Web');
                      });
            })
            ->orderBy('pertanyaan', 'asc')
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
        $operatorEmail = 'pakaji08432@gmail.com'; 

        // Blok Try-Catch hanya membungkus proses pengiriman email
        try {
            if ($operatorEmail != '') {
                Mail::to($operatorEmail)->send(new FaqNotificationMail($faq, 'Operator', false));
                Mail::to($adminEmail)->send(new FaqNotificationMail($faq, 'Admin', true));
            } else {
                Mail::to($adminEmail)->send(new FaqNotificationMail($faq, 'Admin', false));
            }
        } catch (\Exception $e) {
            // Jika Railway memblokir email, error ditangkap di sini sehingga web tidak crash 500.
            // Di lokal (XAMPP), email akan tetap terkirim normal karena tidak diblokir.
        }

        // Baris ini akan SELALU tereksekusi untuk memunculkan pop-up overlay
        return back()->with('success', 'Pertanyaan Anda berhasil diajukan dan sedang menunggu ulasan.');
    }
}