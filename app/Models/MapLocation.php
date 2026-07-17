<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapLocation extends Model
{
    use HasFactory;

    // Ngasih tau Laravel kolom mana aja yang boleh diisi dari form pop-up nanti
    protected $fillable = [
        'type', 
        'title', 
        'manager_label', 
        'manager_name', 
        'contact_label', 
        'contact_number', 
        'address', 
        'latitude', 
        'longitude'
    ];
}