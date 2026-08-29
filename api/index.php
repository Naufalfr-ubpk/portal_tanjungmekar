<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

// 1. Bikin struktur folder di /tmp (satu-satunya folder yang bisa ditulisi di Vercel)
$storagePath = '/tmp/storage';
$directories = [
    "{$storagePath}/logs",
    "{$storagePath}/framework/cache/data",
    "{$storagePath}/framework/sessions",
    "{$storagePath}/framework/views",
    "{$storagePath}/bootstrap/cache",
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// 2. Arahkan direktori view agar tidak nyasar ke folder yang dikunci
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");

// 3. Panggil aplikasi Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// 4. Timpa path storage bawaan Laravel ke /tmp
$app->useStoragePath($storagePath);

// 5. Jalankan Request
$app->handleRequest(Request::capture());