<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12 text-center">
                    <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Informasi Spesifik</h5>
                    <p class="text-white-50 para-desc mx-auto mb-0">Lengkapi informasi tambahan Anda.</p>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi Spesifik</li>
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
                    <div class="card border-0 shadow rounded">
                        <div class="card-header bg-primary p-4">
                            <h5 class="card-title text-white mb-0">Informasi Spesifik</h5>
                        </div>
                        <form wire:submit.prevent="save" class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label">Apakah pernah bekerja di perusahaan ini sebelumnya?</label>
                                <select class="form-select" wire:model.defer="worked_before">
                                    <option value="">Pilih...</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                                @error('worked_before') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jika ya, di lokasi mana Anda bekerja?</label>
                                <input type="text" class="form-control" wire:model.defer="previous_work_location">
                                @error('previous_work_location') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bagaimana Anda mendapatkan informasi pekerjaan ini?</label>
                                <input type="text" class="form-control" wire:model.defer="job_info_source">
                                @error('job_info_source') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Identifikasi Jenis Kelamin</label>
                                <input type="text" class="form-control" wire:model.defer="gender_identity">
                                @error('gender_identity') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('profile.show') }}" class="btn btn-soft-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
