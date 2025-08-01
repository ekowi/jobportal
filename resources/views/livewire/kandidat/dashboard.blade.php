<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Dashboard Kandidat</h5>
                        <p class="text-white-50 para-desc mx-auto mb-0">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                    </div>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <div class="position-relative">
        <div class="shape overflow-hidden text-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="card border-0 text-center features feature-primary feature-clean rounded p-4 shadow">
                        <div class="icons text-center mx-auto">
                            <i class="mdi mdi-briefcase-check-outline d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Lowongan Dilamar</h5>
                            <p class="text-muted">Lihat status semua lamaran pekerjaan yang telah Anda kirim.</p>
                            <a href="{{ route('kandidat.lowongan-dilamar') }}" class="read-more">Lihat Detail <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="card border-0 text-center features feature-primary feature-clean rounded p-4 shadow">
                        <div class="icons text-center mx-auto">
                            <i class="mdi mdi-file-document-edit-outline d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Tes Seleksi</h5>
                            <p class="text-muted">Kerjakan tes seleksi yang tersedia untuk melanjutkan proses rekrutmen.</p>
                            <a href="#" class="read-more">Mulai Tes <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="card border-0 text-center features feature-primary feature-clean rounded p-4 shadow">
                        <div class="icons text-center mx-auto">
                            <i class="mdi mdi-account-cog-outline d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Profil & Dokumen</h5>
                            <p class="text-muted">Pastikan profil dan dokumen Anda selalu lengkap dan terbaru.</p>
                            <a href="{{ route('profile.show') }}" class="read-more">Update Profil <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Lowongan Terbaru</h4>
                        <a href="{{ route('jobs.index') }}" class="btn btn-link">Lihat Semua Lowongan <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- Bagian lowongan terbaru --}}
            <div class="row">
                @php
                    $kolomClass = 'col-md-6 col-lg-4 col-xl-3'; // Responsive: 2 di md, 3 di lg, 4 di xl
                @endphp
                
                @forelse($lowonganTerbaru as $lowongan)
                <div class="{{ $kolomClass }} mb-4">
                    <div class="card job-box rounded shadow h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6><a href="#" wire:click.prevent="showJob({{ $lowongan->id }})" class="text-dark">{{ $lowongan->nama_posisi }}</a></h6>
                                <span class="badge bg-soft-success">{{ $lowongan->tipe_pekerjaan ?? 'Full-time' }}</span>
                            </div>
                            <div class="mt-2">
                                <span class="text-muted d-block"><i class="mdi mdi-office-building-outline me-1"></i>{{ $lowongan->departemen }}</span>
                                <span class="text-muted d-block mt-1"><i class="mdi mdi-map-marker-outline me-1"></i>{{ $lowongan->lokasi_penugasan }}</span>
                                <span class="text-muted d-block mt-1"><i class="mdi mdi-cash-multiple me-1"></i>{{ $lowongan->range_gaji }} Juta</span>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-soft-primary me-1">{{ optional($lowongan->kategoriLowongan)->nama_kategori }}</span>
                                <span class="badge bg-soft-warning">Berakhir: {{ \Carbon\Carbon::parse($lowongan->tanggal_berakhir)->format('d M Y') }}</span>
                            </div>
                            <div class="mt-3">
                                <a href="#" wire:click.prevent="showJob({{ $lowongan->id }})" class="btn btn-sm btn-primary">Lamar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada lowongan tersedia saat ini.
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Link paginasi --}}
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-center">
                        {{ $lowonganTerbaru->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if($showJobModal && $selectedLowongan)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $selectedLowongan->nama_posisi }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p><i class="mdi mdi-office-building-outline me-1"></i><strong>Departemen:</strong> {{ $selectedLowongan->departemen }}</p>
                        <p><i class="mdi mdi-map-marker-outline me-1"></i><strong>Lokasi:</strong> {{ $selectedLowongan->lokasi_penugasan }}</p>
                        <p><i class="mdi mdi-currency-usd me-1"></i><strong>Gaji:</strong> {{ $selectedLowongan->range_gaji }} IDR</p>
                    </div>
                    <hr>
                    <h5>Deskripsi Pekerjaan</h5>
                    <div>
                        {!! $selectedLowongan->deskripsi !!}
                    </div>
                    <hr>
                    <h5>Kemampuan yang Dibutuhkan</h5>
                    <p>{{ $selectedLowongan->kemampuan_yang_dibutuhkan }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                    <button type="button" 
                        wire:click="applyJob({{ $selectedLowongan->id }})" 
                        class="btn btn-primary"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="applyJob">
                            <i class="mdi mdi-loading mdi-spin me-1"></i>
                        </span>
                        Lamar Pekerjaan Ini
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@if (session()->has('error'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1061">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif