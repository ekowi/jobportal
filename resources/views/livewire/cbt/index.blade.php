<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Tes Seleksi</h5>
                    </div>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tes Seleksi</li>
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
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h4 class="mb-4 text-center">Daftar Psikotes</h4>

                    @forelse($lamarans as $lamaran)
                        <div class="card shadow-sm mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $lamaran->lowongan->nama_posisi }}</h5>
                                    <p class="mb-0 text-muted">{{ $lamaran->lowongan->departemen }} - {{ $lamaran->lowongan->lokasi_penugasan }}</p>
                                </div>
                                <a href="{{ route('cbt.test') }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-pencil me-1"></i>Mulai Psikotes
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center" role="alert">
                            Belum ada tes psikotes yang tersedia untuk Anda.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
