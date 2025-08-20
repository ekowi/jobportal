<?php
// TODO: Add role-based redirection middleware, Add role for each role type in officer
use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Kandidat\Dashboard::class)->name('dashboard');
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
Route::get('/kategori', App\Livewire\KategoriLowongan\ListKategori::class)->name('kategori.list');
Route::get('/list-lowongan', App\Livewire\Lowongan\ListLowongan::class)->name('lowongan.list');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:officer', // Ensure the user has the 'officer' role
])->group(function () {
    Route::get('/officers', App\Livewire\Officer\Index::class)->name('officers.index');
    Route::get('/kategori-lowongan', App\Livewire\KategoriLowongan\Index::class)->name('kategori-lowongan.Index');
    Route::get('/lowongan', App\Livewire\Lowongan\Index::class)->name('lowongan.index');
    Route::get('/lowongan/create', App\Livewire\Lowongan\Create::class)->name('lowongan.create');
    Route::get('/lowongan/{id}/edit', App\Livewire\Lowongan\Edit::class)->name('lowongan.edit');
    Route::get('/recruitment-progress', App\Livewire\ProgressRekrutmenTimeline::class)->name('recruitment.progress');
    Route::get('/bank-soal', App\Livewire\BankSoal\Index::class)->name('bank-soal.index');
    Route::get('/kategori-soal', App\Livewire\KategoriSoal\Index::class)->name('kategori-soal.index');
    Route::get('/Lowongan/Index', App\Livewire\Lowongan\Index::class)->name('Lowongan.Index');
    Route::get('/Lowongan/Create', App\Livewire\Lowongan\Create::class)->name('Lowongan.Create');
    Route::get('/test-results', App\Livewire\Officer\TestResults\Index::class)->name('test-results.index');
    Route::get('kandidat', App\Livewire\Officer\Kandidat\Index::class)->name('kandidat.index');
    Route::get('/lamaran-lowongan', App\Livewire\Officer\LamaranLowongan\Index::class)
    ->name('lamaran-lowongan.index');
    Route::get('/jadwal-interview', App\Livewire\Officer\InterviewSchedule\Index::class)
    ->name('jadwal-interview.index');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:kandidat',
])->group(function () {
    Route::get('/kandidat/complete-apply', App\Livewire\Kandidat\CompleteApply::class)->name('kandidat.settings');
    Route::get('/lowongan-dilamar', App\Livewire\Kandidat\LowonganDilamar\Index::class)->name('kandidat.lowongan-dilamar');
    Route::get('/kandidat/lowongan-dilamar', App\Livewire\Kandidat\LowonganDilamar\Index::class)
        ->name('kandidat.lowongan-dilamar');
    Route::get('/cbt/test', App\Livewire\Cbt\Test::class)->name('cbt.test');
    Route::get('/profile', App\Livewire\Profile\ShowProfile::class)->name('profile.show');
    Route::get('/profile/edit', App\Livewire\Profile\UpdateKandidatProfileForm::class)->name('profile.edit');
    Route::get('/profile/experience', App\Livewire\Profile\UpdateWorkExperience::class)->name('profile.experience');
    Route::get('/profile/education', App\Livewire\Profile\UpdateEducationHistory::class)->name('profile.education');
    Route::get('/profile/language', App\Livewire\Profile\UpdateLanguageSkills::class)->name('profile.language');
    Route::get('/profile/specific-info', App\Livewire\Profile\UpdateSpecificInfo::class)->name('profile.specific');
});
