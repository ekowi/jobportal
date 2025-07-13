<?php
// TODO: Add role-based redirection middleware, Add role for each role type in officer
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('maintenance');
});
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:officer', // Ensure the user has the 'officer' role
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/officers', App\Livewire\Officer\Index::class)->name('officers.index');
    Route::get('/kategori-lowongan', App\Livewire\KategoriLowongan\Index::class)->name('kategori-lowongan.index');
    Route::get('/lowongan', App\Livewire\Lowongan\Index::class)->name('lowongan.index');
    Route::get('/lowongan/create', App\Livewire\Lowongan\Create::class)->name('lowongan.create');
    Route::get('/lowongan/{id}/edit', App\Livewire\Lowongan\Edit::class)->name('lowongan.edit');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:kandidat', // Ensure the user has the 'kandidat' role
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
