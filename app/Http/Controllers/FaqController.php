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
        // Narik semua FAQ yang dipublikasi (baik dari warga maupun bawaan web)
        $faqs = Faq::where('status', 'dipublikasi')->latest()->get();
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
        $operatorEmail = ''; // Nanti isi email Pak Aji di sini kalau udah ada

        if ($operatorEmail != '') {
            Mail::to($operatorEmail)->send(new FaqNotificationMail($faq, 'Operator', false));
            Mail::to($adminEmail)->send(new FaqNotificationMail($faq, 'Admin', true));
        } else {
            Mail::to($adminEmail)->send(new FaqNotificationMail($faq, 'Admin', false));
        }

        return back()->with('success', 'Pertanyaan Anda berhasil diajukan dan sedang menunggu ulasan.');
    }
}