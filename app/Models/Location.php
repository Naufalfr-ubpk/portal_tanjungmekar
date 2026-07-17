<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'title', 'manager_label', 'manager_name', 
        'contact_label', 'contact_number', 'latitude', 'longitude', 'address'
    ];
}