<div>
    <!-- Hero Start -->
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
    <!-- Hero End -->

    <!-- Content Start -->
    <section class="section">
        <div class="container">
            <!-- Main Dashboard Cards -->
            <div class="row">
                <!-- Lowongan yang Dilamar -->
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

                <!-- Tes yang Harus Dikerjakan -->
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

                <!-- Profil dan Dokumen -->
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

            <!-- Lowongan Terbaru -->
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Lowongan Terbaru</h4>
                        <a href="#" class="btn btn-link">Lihat Semua Lowongan <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                    <div class="row">
                        <!-- Contoh Kartu Lowongan 1 -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card job-box rounded shadow">
                                <div class="card-body p-4">
                                    <h6><a href="#" class="text-dark">Senior Web Developer</a></h6>
                                    <p class="text-muted">PT. Teknologi Maju, Jakarta</p>
                                    <a href="#" class="btn btn-sm btn-primary mt-2">Lamar Sekarang</a>
                                </div>
                            </div>
                        </div>

                        <!-- Contoh Kartu Lowongan 2 -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card job-box rounded shadow">
                                <div class="card-body p-4">
                                    <h6><a href="#" class="text-dark">UI/UX Designer</a></h6>
                                    <p class="text-muted">Startup Kreatif, Bandung</p>
                                    <a href="#" class="btn btn-sm btn-primary mt-2">Lamar Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <!-- Loop untuk lowongan lain bisa ditambahkan di sini -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content End -->
</div>