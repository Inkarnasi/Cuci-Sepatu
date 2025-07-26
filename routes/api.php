<?php

use App\Http\Controllers\API\ApiCategoryLayananController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiLoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [ApiLoginController::class, 'login']);
Route::post('/logout', [ApiLoginController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('category-layanan')->group(function () {
    Route::get('/', [ApiCategoryLayananController::class, 'index']);  // Menampilkan semua category
    Route::get('{uuid}', [ApiCategoryLayananController::class, 'show']);  // Menampilkan kategori berdasarkan UUID
    Route::post('/', [ApiCategoryLayananController::class, 'store']);  // Membuat kategori baru
    Route::put('{uuid}', [ApiCategoryLayananController::class, 'update']);  // Mengupdate kategori berdasarkan UUID
    Route::delete('{uuid}', [ApiCategoryLayananController::class, 'destroy']);  // Menghapus kategori berdasarkan UUID
});

