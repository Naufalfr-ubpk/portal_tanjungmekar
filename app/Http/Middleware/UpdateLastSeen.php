<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UpdateLastSeen
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Tembak langsung ke database, 100% akurat dan mengabaikan updated_at
            User::where('id', Auth::id())->update(['last_seen_at' => now()]);
        }
        return $next($request);
    }
}