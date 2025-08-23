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

    <section class="section">
        <div class="container">
            <!-- Filter dan Pencarian -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari psikotes..." wire:model.live="search">
                        <button class="btn btn-primary" type="button">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel Psikotes -->
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shadow rounded">
                        <table class="table table-center bg-white mb-0">
                            <thead>
                                <tr>
                                    <th class="border-bottom p-3">Posisi</th>
                                    <th class="border-bottom p-3">Departemen</th>
                                    <th class="border-bottom p-3">Lokasi Penugasan</th>
                                    <th class="border-bottom p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($filteredLamarans as $lamaran)
                                    <tr>
                                        <td class="p-3">{{ $lamaran->lowongan->nama_posisi }}</td>
                                        <td class="p-3">{{ $lamaran->lowongan->departemen }}</td>
                                        <td class="p-3">{{ $lamaran->lowongan->lokasi_penugasan }}</td>
                                        <td class="p-3">
                                            <a href="{{ route('cbt.test') }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="mdi mdi-pencil me-1"></i>Mulai Psikotes
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-3">Belum ada tes psikotes yang tersedia untuk Anda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
