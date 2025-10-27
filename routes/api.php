<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use Illuminate\Http\Request;
use App\Http\Middleware\CorsMiddleware;

// Middleware CORS khusus untuk semua route API
Route::middleware([CorsMiddleware::class])->group(function () {

    // Auth API
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']); 

    // Route testing
    Route::get('/ping', function () {
        return response()->json(['message' => 'API is working']);
    });

    // API Resource Dokter & Pasien
    Route::apiResource('dokters', DokterController::class);
    Route::apiResource('pasiens', PasienController::class);

    // Semua dokter beserta pasien
    Route::get('/dokters-with-pasiens', [DokterController::class, 'indexWithPasiens']);

    // CRUD Dokter 
    Route::get('/dokters', [DokterController::class, 'index']); 
    Route::get('/dokters/{id}', [DokterController::class, 'show']);
    Route::post('/dokters', [DokterController::class, 'store']);
    Route::put('/dokters/{id}', [DokterController::class, 'update']);
    Route::delete('/dokters/{id}', [DokterController::class, 'destroy']);

    // CRUD Pasien 
    Route::get('/pasiens', [PasienController::class, 'index']); 
    Route::get('/pasiens/{id}', [PasienController::class, 'show']); 
    Route::post('/pasiens', [PasienController::class, 'store']); 
    Route::put('/pasiens/{id}', [PasienController::class, 'update']); 
    Route::delete('/pasiens/{id}', [PasienController::class, 'destroy']); 
});

// OPTIONS route untuk preflight CORS
Route::options('{any}', function() {
    return response()->json([], 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
})->where('any', '.*');

