<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12 text-center">
                    <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Riwayat Pendidikan</h5>
                    <p class="text-white-50 para-desc mx-auto mb-0">Tambahkan riwayat pendidikan Anda di sini.</p>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendidikan</li>
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
                            <h5 class="card-title text-white mb-0">Riwayat Pendidikan</h5>
                        </div>
                        <form wire:submit.prevent="save" class="card-body p-4">
                            @foreach ($educations as $index => $edu)
                                <div class="border rounded p-3 mb-3">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" wire:model.defer="educations.{{ $index }}.start">
                                            @error('educations.' . $index . '.start') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" wire:model.defer="educations.{{ $index }}.end">
                                            @error('educations.' . $index . '.end') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Pendidikan</label>
                                            <input type="text" class="form-control" wire:model.defer="educations.{{ $index }}.name">
                                            @error('educations.' . $index . '.name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jurusan</label>
                                            <input type="text" class="form-control" wire:model.defer="educations.{{ $index }}.major">
                                            @error('educations.' . $index . '.major') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tingkat Pendidikan</label>
                                            <input type="text" class="form-control" wire:model.defer="educations.{{ $index }}.level">
                                            @error('educations.' . $index . '.level') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Pendidikan Tertinggi</label>
                                            <select class="form-select" wire:model.defer="educations.{{ $index }}.highest">
                                                <option value="0">Tidak</option>
                                                <option value="1">Ya</option>
                                            </select>
                                            @error('educations.' . $index . '.highest') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-sm btn-danger" wire:click="removeEducation({{ $index }})">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-secondary" wire:click="addEducation">Tambah Pendidikan</button>
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
