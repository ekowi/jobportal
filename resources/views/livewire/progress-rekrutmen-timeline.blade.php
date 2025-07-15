<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('images/hero/bg.jpg');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">{{ __('Officers') }}</h5>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Officers') }}</li>
                    </ul>
                </nav>
            </div>
        </div><!--end container-->
    </section><!--end section-->
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
                    <div class="card p-4 border-0 rounded shadow">
                        <!-- Search and Filter -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="search-bar p-0 d-lg-block ms-2">
                                    <div id="search" class="menu-search mb-0">
                                        <div class="input-group">
                                            <input type="text" wire:model.debounce.500ms="search" class="form-control border bg-white" placeholder="Cari nama kandidat atau posisi...">
                                            <button type="submit" class="input-group-text bg-primary border-primary text-white"><i class="uil uil-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <select wire:model="filterLowongan" class="form-select">
                                    <option value="">Semua Lowongan</option>
                                    @foreach($lowongans as $lowongan)
                                        <option value="{{ $lowongan->id }}">{{ $lowongan->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <select wire:model="filterStatus" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="proses">Sedang Proses</option>
                                    <option value="gagal">Gagal</option>
                                </select>
                            </div>
                        </div>

                        <!-- Timeline Cards -->
                        <div class="row">
                            @forelse($lamarLowongans as $lamarLowongan)
                                <div class="col-12 mb-4">
                                    <div class="card border-0 shadow rounded">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-0">{{ $lamarLowongan->kandidat->nama }}</h5>
                                                    <p class="text-muted mb-0">{{ $lamarLowongan->lowongan->judul }}</p>
                                                </div>
                                                <span class="badge rounded-pill bg-soft-primary px-3 py-1">
                                                    {{ $lamarLowongan->created_at->format('d M Y') }}
                                                </span>
                                            </div>

                                            <!-- Timeline -->
                                            <div class="timeline-page mt-4">
                                                @php
                                                    $progresses = $this->progressRekrutmenRepository->getProgressByLamarLowonganId($lamarLowongan->id);
                                                @endphp

                                                @forelse($progresses as $index => $progress)
                                                    <div class="timeline-item {{ $index === count($progresses)-1 ? '' : 'mb-4' }}">
                                                        <div class="d-flex">
                                                            <div class="timeline-icon">
                                                                <span class="badge rounded-circle bg-{{ $this->getStatusColor($progress->status) }}">
                                                                    <i class="uil uil-check"></i>
                                                                </span>
                                                            </div>
                                                            <div class="card timeline-content rounded ms-3" style="border-left: 5px solid var(--bs-{{ $this->getStatusColor($progress->status) }});">
                                                                <div class="card-body p-3">
                                                                    <div class="d-flex justify-content-between mb-2">
                                                                        <h6 class="mb-0">{{ $progress->nama_progress }}</h6>
                                                                        <small class="text-muted">{{ $progress->waktu_pelaksanaan->format('d M Y H:i') }}</small>
                                                                    </div>
                                                                    <p class="text-muted mb-2 text-truncate">
                                                                        {{ Str::limit($progress->catatan, 100) }}
                                                                    </p>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="badge bg-{{ $this->getStatusColor($progress->status) }} rounded-pill me-2">
                                                                            {{ $progress->status }}
                                                                        </span>
                                                                        @if($progress->is_interview)
                                                                            <span class="badge bg-info rounded-pill me-2">Interview</span>
                                                                        @endif
                                                                        @if($progress->is_psikotes)
                                                                            <span class="badge bg-warning rounded-pill me-2">Psikotes</span>
                                                                        @endif

                                                                        <button wire:click="showProgressDetail({{ $progress->id }})"
                                                                                class="btn btn-sm btn-soft-primary ms-auto">
                                                                            Detail
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="text-center p-3">
                                                        <p class="text-muted">Belum ada progress rekrutmen tercatat</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="card border-0 shadow rounded">
                                        <div class="card-body p-4 text-center">
                                            <div class="mb-3">
                                                <i class="uil uil-search-alt h1 text-muted"></i>
                                            </div>
                                            <h5>Data Tidak Ditemukan</h5>
                                            <p class="text-muted">Tidak ada data rekrutmen yang sesuai dengan filter.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                            <!-- Pagination -->
                            <div class="col-12">
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $lamarLowongans->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail -->
                        @if($showDetail && $selectedProgress)
                        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5)" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content rounded shadow border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Progress: {{ $selectedProgress->nama_progress }}</h5>
                                        <button type="button" class="btn-close" wire:click="closeDetail"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Kandidat</label>
                                                <h6>{{ $selectedProgress->lamarlowongan->kandidat->nama }}</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Lowongan</label>
                                                <h6>{{ $selectedProgress->lamarlowongan->lowongan->judul }}</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Status</label>
                                                <div>
                                                    <span class="badge bg-{{ $this->getStatusColor($selectedProgress->status) }} rounded-pill">
                                                        {{ $selectedProgress->status }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Waktu Pelaksanaan</label>
                                                <h6>{{ $selectedProgress->waktu_pelaksanaan->format('d M Y H:i') }}</h6>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Officer</label>
                                                <h6>{{ $selectedProgress->officer->user->name ?? 'Tidak ada' }}</h6>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Catatan</label>
                                                <div class="p-3 bg-light rounded">
                                                    {!! nl2br(e($selectedProgress->catatan)) !!}
                                                </div>
                                            </div>

                                            @if($selectedProgress->dokumen_pendukung)
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Dokumen Pendukung</label>
                                                <div>
                                                    <a href="{{ asset('storage/' . $selectedProgress->dokumen_pendukung) }}"
                                                        class="btn btn-soft-primary btn-sm" target="_blank">
                                                        <i class="uil uil-file-download"></i> Download Dokumen
                                                    </a>
                                                </div>
                                            </div>
                                            @endif

                                            @if($selectedProgress->is_interview && $selectedProgress->interview)
                                            <div class="col-12 mt-3">
                                                <h6 class="mb-3">Detail Interview</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th width="30%">Interviewer</th>
                                                            <td>{{ $selectedProgress->interview->interviewer }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Hasil Interview</th>
                                                            <td>{{ $selectedProgress->interview->hasil_interview }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Rekomendasi</th>
                                                            <td>{{ $selectedProgress->interview->rekomendasi }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" wire:click="closeDetail">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <style>
        /* Timeline styles */
        .timeline-page {
            position: relative;
            padding-left: 10px;
        }

        .timeline-page:before {
            content: "";
            position: absolute;
            height: 100%;
            width: 2px;
            background-color: #eee;
            left: 13px;
            top: 0;
        }

        .timeline-item {
            position: relative;
        }

        .timeline-icon {
            z-index: 2;
        }

        .timeline-icon span {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timeline-content {
            width: calc(100% - 40px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        /* Status colors */
        .bg-soft-primary {
            background-color: rgba(47, 85, 212, 0.1) !important;
            color: var(--bs-primary);
        }

        .bg-soft-success {
            background-color: rgba(40, 167, 69, 0.1) !important;
            color: var(--bs-success);
        }

        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
            color: var(--bs-warning);
        }

        .bg-soft-danger {
            background-color: rgba(220, 53, 69, 0.1) !important;
            color: var(--bs-danger);
        }

        .bg-soft-info {
            background-color: rgba(23, 162, 184, 0.1) !important;
            color: var(--bs-info);
        }
    </style>
</div>
