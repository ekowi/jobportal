<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Kelola Lamaran</h5>
                    </div>
                </div>
            </div>

            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Lamaran</li>
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
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                                <div>
                                    <h6 class="mb-1">Daftar Lamaran</h6>
                                    <p class="text-muted mb-0">Ubah status lamaran kandidat via dropdown.</p>
                                </div>
                                <div class="w-100 w-md-50" style="max-width: 360px;">
                                    <div class="position-relative">
                                        <i class="mdi mdi-magnify position-absolute top-50 translate-middle-y ms-3"></i>
                                        <input type="text" wire:model.debounce.300ms="search" class="form-control ps-5" placeholder="Cari kandidat atau posisi...">
                                    </div>
                                </div>
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
                                    {{-- Atur persentase kolom dengan colgroup --}}
                                    <colgroup>
                                        <col style="width:5%;">
                                        <col style="width:25%;">   {{-- Kandidat --}}
                                        <col style="width:22%;">   {{-- Posisi --}}
                                        <col style="width:16%;">   {{-- Tanggal Lamar --}}
                                        <col style="width:32%;">   {{-- Aksi --}}
                                    </colgroup>

                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Kandidat</th>
                                            <th>Posisi</th>
                                            <th class="text-center">Tanggal Lamar</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($lamaranList as $index => $lamaran)
                                            @php
                                                $latest = optional($lamaran->progressRekrutmen)->last();
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $lamaranList->firstItem() + $index }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar avatar-md rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                            <i class="mdi mdi-account-outline"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold">{{ optional($lamaran->kandidat->user)->name ?? '-' }}</div>
                                                            <div class="text-muted small">{{ optional($lamaran->kandidat)->email ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>{{ optional($lamaran->lowongan)->nama_posisi ?? '-' }}</td>

                                                <td class="text-center">{{ optional($lamaran->created_at)->format('d M Y') }}</td>

                                                <td>
                                                    {{-- Badge status terakhir (jika ada) --}}
                                                    @if($latest)
                                                        <div class="mb-2">
                                                            @php
                                                                $color = 'info';
                                                                if ($latest->status === 'diterima') $color = 'success';
                                                                elseif ($latest->status === 'ditolak') $color = 'danger';
                                                            @endphp
                                                            <span class="badge bg-{{ $color }}">
                                                                {{ ucfirst($latest->status) }}
                                                            </span>
                                                        </div>
                                                    @endif

                                                    {{-- Detail Interview --}}
                                                    @if($latest && $latest->is_interview)
                                                        <div class="mb-2">
                                                            <div class="small text-muted">Waktu: {{ optional($latest->waktu_pelaksanaan)->format('d M Y H:i') }}</div>
                                                            <div class="small text-muted">Interviewer: {{ optional($latest->officer)->name }}</div>
                                                            @if($latest->link_zoom)
                                                                <a href="{{ $latest->link_zoom }}" target="_blank" class="d-block small text-primary">
                                                                    <i class="mdi mdi-video me-1"></i> Link Zoom
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    {{-- Dropdown ubah status --}}
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                                                id="dropdownStatus{{ $lamaran->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Ubah Status
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownStatus{{ $lamaran->id }}">
                                                            <li>
                                                                <a href="#" class="dropdown-item"
                                                                   wire:click.prevent="setStatus({{ $lamaran->id }}, 'diterima')">
                                                                    <i class="mdi mdi-check-circle-outline me-1"></i> Diterima
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="dropdown-item"
                                                                   wire:click.prevent="prepareInterview({{ $lamaran->id }})">
                                                                    <i class="mdi mdi-calendar-clock me-1"></i> Interview
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="dropdown-item"
                                                                   wire:click.prevent="setStatus({{ $lamaran->id }}, 'psikotes')">
                                                                    <i class="mdi mdi-brain me-1"></i> Psikotes
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a href="#" class="dropdown-item text-danger"
                                                                   wire:click.prevent="setStatus({{ $lamaran->id }}, 'ditolak')">
                                                                    <i class="mdi mdi-close-circle-outline me-1"></i> Tolak
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="text-center py-5">
                                                        <img src="{{ asset('images/illustrations/empty.svg') }}" alt="" class="mb-3" style="height: 80px;">
                                                        <h6 class="mb-1">Belum Ada Lamaran</h6>
                                                        <p class="text-muted mb-0">Lamaran akan tampil di sini setelah kandidat melamar lowongan.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $lamaranList->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal Jadwalkan Interview -->
    <div class="modal fade @if($interviewModal) show @endif" tabindex="-1" style="@if($interviewModal) display:block; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="saveInterview">
                    <div class="modal-header">
                        <h5 class="modal-title">Jadwalkan Interview</h5>
                        <button type="button" class="btn-close" wire:click="$set('interviewModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Link Zoom</label>
                            <input type="url" class="form-control" wire:model.defer="interviewLink" required>
                            @error('interviewLink') <div class="small text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu Pelaksanaan</label>
                            <input type="datetime-local" class="form-control" wire:model.defer="interviewWaktu" required>
                            @error('interviewWaktu') <div class="small text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Interviewer</label>
                            <select class="form-select" wire:model.defer="interviewOfficer" required>
                                <option value="">Pilih Officer</option>
                                @foreach($officerList as $officer)
                                    <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                @endforeach
                            </select>
                            @error('interviewOfficer') <div class="small text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" wire:click="$set('interviewModal', false)">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
