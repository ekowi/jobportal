<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Spesifik Informasi</h5>
                        <p class="text-white-50 para-desc mx-auto mb-0">Lengkapi informasi spesifik terkait pekerjaan.</p>
                    </div>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Spesifik Informasi</li>
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
                <div class="col-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-header bg-primary p-4">
                            <h5 class="card-title text-white mb-0">
                                <i class="mdi mdi-information-outline me-2"></i>Spesifik Informasi
                            </h5>
                            <p class="text-white-50 mb-0 mt-1">Lengkapi informasi spesifik terkait pekerjaan.</p>
                        </div>
                        <form class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label">Apakah pernah bekerja di Perusahaan ini sebelumnya?</label>
                                <select class="form-select" name="pernah_bekerja">
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jika ya, di lokasi mana Anda bekerja?</label>
                                <input type="text" class="form-control" name="lokasi_kerja" placeholder="Lokasi">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bagaimana Anda mendapatkan informasi pekerjaan ini?</label>
                                <input type="text" class="form-control" name="sumber_info" placeholder="Sumber Informasi">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Identifikasi Jenis Kelamin</label>
                                <select class="form-select" name="identifikasi_kelamin">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
