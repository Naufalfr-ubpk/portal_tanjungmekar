<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan', 
        'detail_pertanyaan', 
        'jawaban', 
        'nama_penanya', 
        'email_penanya', 
        'status',
        'action_button_text',
        'action_link',
        'is_bawaan' // BARU: Buat misahin bawaan web & warga
    ];
}