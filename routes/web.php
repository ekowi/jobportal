<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('maintenance');
});
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/officers', App\Livewire\Officer\Index::class)->name('officers.index');
    Route::get('/kategori-lowongan', App\Livewire\KategoriLowongan\Index::class)->name('kategori-lowongan.index');
});
