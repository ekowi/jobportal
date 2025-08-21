<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Jadwal Interview</h5>
                    </div>
                </div>
            </div>

            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('officers.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Interview</li>
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

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow rounded-3">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                                <h6 class="mb-1">Daftar Jadwal Interview</h6>
                                <p class="text-muted mb-0">Kelola hasil interview kandidat Anda.</p>
                            </div>

                            @if (session()->has('success'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <i class="mdi mdi-check-circle-outline me-2"></i>
                                    <div>{{ session('success') }}</div>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                                    <div>{{ session('error') }}</div>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-centered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width:5%;">#</th>
                                            <th style="width:35%;">Kandidat</th>
                                            <th style="width:25%;">Waktu</th>
                                            <th style="width:20%;">Link Zoom</th>
                                            <th style="width:15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($interviews as $index => $progress)
                                            <tr>
                                                <td class="text-center">{{ $interviews->firstItem() + $index }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar avatar-md rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                            <i class="mdi mdi-account-outline"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold">{{ optional($progress->lamarlowongan->kandidat->user)->name ?? '-' }}</div>
                                                            <div class="text-muted small">{{ optional($progress->lamarlowongan->kandidat)->email ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ optional($progress->waktu_pelaksanaan)->format('d M Y H:i') }}</td>
                                                <td>
                                                    @if($progress->link_zoom)
                                                        <a href="{{ $progress->link_zoom }}" target="_blank" class="d-block small text-primary">
                                                            <i class="mdi mdi-video me-1"></i> Link Zoom
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-primary btn-sm" wire:click="openResultModal({{ $progress->id }})">
                                                        <i class="mdi mdi-upload"></i> Hasil Interview
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada jadwal interview.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $interviews->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Hasil Interview -->
    <div class="modal fade @if($resultModal) show @endif" tabindex="-1" style="@if($resultModal) display:block; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="saveResult" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Hasil Interview</h5>
                        <button type="button" class="btn-close" wire:click="$set('resultModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control" wire:model.defer="resultCatatan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dokumen Pendukung</label>
                            <input type="file" class="form-control" wire:model="resultDokumen">
                            @error('resultDokumen') <div class="small text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" wire:click="$set('resultModal', false)">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
