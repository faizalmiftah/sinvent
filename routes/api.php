<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;




// menampilkan semua kategori
Route::get('/showkategori', [KategoriController::class, 'showAPIKategori']);

// menampilkan detail kategori
Route::get('/kategoriid/{id}', [KategoriController::class, 'getAPIKategori']);

// membuat kategori
Route::post('/createkategori', [KategoriController::class, 'createAPIKategori']);

// update kategori
Route::put('/editkategori/{kategori_id}', [KategoriController::class, 'updateAPIKategori']);

// hapus kategori
Route::delete('/deletekategori/{kategori_id}', [KategoriController::class, 'deleteAPIKategori']);


