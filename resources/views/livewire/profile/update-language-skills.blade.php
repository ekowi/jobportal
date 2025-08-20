<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12 text-center">
                    <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Keterampilan Bahasa</h5>
                    <p class="text-white-50 para-desc mx-auto mb-0">Tambahkan kemampuan bahasa Anda di sini.</p>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bahasa</li>
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
                <div class="col-lg-10">
                    <div class="card border-0 shadow rounded">
                        <div class="card-header bg-primary p-4">
                            <h5 class="card-title text-white mb-0">Keterampilan Bahasa</h5>
                        </div>
                        <form wire:submit.prevent="save" class="card-body p-4">
                            @foreach ($languages as $index => $lang)
                                <div class="border rounded p-3 mb-3">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Bahasa</label>
                                            <input type="text" class="form-control" wire:model.defer="languages.{{ $index }}.language">
                                            @error('languages.' . $index . '.language') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Kemahiran Berbicara</label>
                                            <input type="text" class="form-control" wire:model.defer="languages.{{ $index }}.speaking">
                                            @error('languages.' . $index . '.speaking') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Kemahiran Membaca</label>
                                            <input type="text" class="form-control" wire:model.defer="languages.{{ $index }}.reading">
                                            @error('languages.' . $index . '.reading') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Kemahiran Menulis</label>
                                            <input type="text" class="form-control" wire:model.defer="languages.{{ $index }}.writing">
                                            @error('languages.' . $index . '.writing') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-sm btn-danger" wire:click="removeLanguage({{ $index }})">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-secondary" wire:click="addLanguage">Tambah Bahasa</button>
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
