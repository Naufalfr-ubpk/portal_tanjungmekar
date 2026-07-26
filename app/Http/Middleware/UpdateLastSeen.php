<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateLastSeen
{
    public function handle(Request $request, Closure $next)
    {
        // Jalankan request utama dulu biar Session & Auth Laravel benar-benar ke-load 100%
        $response = $next($request);

        if (Auth::check()) {
            // Update pakai DB facade biar ringan, akurat, dan menembus proteksi model
            DB::table('users')
                ->where('id', Auth::id())
                ->update(['last_seen_at' => now()]);
        }

        return $response;
    }
}