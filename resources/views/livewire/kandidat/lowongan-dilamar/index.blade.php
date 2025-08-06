<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Daftar lowongan</h5>
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

    <!-- Start -->
    <section class="section">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-12 md:col-span-12">
                    <div class="grid grid-cols-1 gap-[30px]">
                        <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                            <div class="mb-4">
                                <input type="text" wire:model.debounce.300ms="search" 
                                    class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0" 
                                    placeholder="Cari berdasarkan nama posisi...">
                            </div>

                            <div class="mb-4">
                                <select wire:model="status" class="form-select w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="interview">Interview</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>

                            @foreach($lamaranList as $lowongan)
                            <div class="card job-box rounded shadow border-0 mb-4 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <!-- Logo/Image Container -->
                                            <div class="flex-shrink-0 me-3">
                                                @if($lowongan->foto)
                                                    <div class="rounded shadow" style="width: 60px; height: 60px; overflow: hidden;">
                                                        <img src="{{ asset('storage/image/lowongan/' . $lowongan->foto) }}" 
                                                             alt="Foto Lowongan" 
                                                             class="img-fluid" 
                                                             style="width: 100%; height: 100%; object-fit: contain; background: white; padding: 8px;">
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center bg-light rounded shadow" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="mdi mdi-briefcase-outline text-muted" style="font-size: 24px;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Job Info -->
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-bold">{{ $lowongan->nama_posisi }}</h5>
                                                <p class="text-muted mb-2 d-flex align-items-center">
                                                    <i class="mdi mdi-office-building-outline me-1"></i>
                                                    {{ $lowongan->departemen }}
                                                </p>
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <span class="text-muted small d-flex align-items-center">
                                                        <i class="mdi mdi-map-marker-outline me-1"></i>
                                                        {{ $lowongan->lokasi_penugasan }}
                                                        @if($lowongan->is_remote)
                                                            <span class="badge bg-soft-success ms-1">Remote</span>
                                                        @else
                                                            <span class="badge bg-soft-secondary ms-1">Onsite</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Status Badge -->
                                        <div class="flex-shrink-0">
                                            <span class="badge {{ $lowongan->pivot->status === 'diterima' ? 'bg-success' : ($lowongan->pivot->status === 'ditolak' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ ucfirst($lowongan->pivot->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Additional Info -->
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-6">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="mdi mdi-tag-outline me-1"></i>
                                                {{ $lowongan->kategoriLowongan->nama_kategori }}
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="mdi mdi-calendar-outline me-1"></i>
                                                Dilamar: {{ $lowongan->pivot->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Salary Range (if available) -->
                                    @if(isset($lowongan->range_gaji))
                                    <div class="mb-2">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="mdi mdi-cash-multiple me-1"></i>
                                            {{ $lowongan->range_gaji }} Juta
                                        </small>
                                    </div>
                                    @endif

                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                        <div class="d-flex gap-2">
                                            @if($lowongan->pivot->status === 'pending')
                                                <span class="badge bg-soft-warning">
                                                    <i class="mdi mdi-clock-outline me-1"></i>
                                                    Menunggu Review
                                                </span>
                                            @elseif($lowongan->pivot->status === 'interview')
                                                <span class="badge bg-soft-info">
                                                    <i class="mdi mdi-account-voice me-1"></i>
                                                    Tahap Interview
                                                </span>
                                            @elseif($lowongan->pivot->status === 'diterima')
                                                <span class="badge bg-soft-success">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>
                                                    Diterima
                                                </span>
                                            @else
                                                <span class="badge bg-soft-danger">
                                                    <i class="mdi mdi-close-circle-outline me-1"></i>
                                                    Ditolak
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <button class="btn btn-sm btn-soft-primary" onclick="viewDetails({{ $lowongan->id }})">
                                                <i class="mdi mdi-eye me-1"></i>Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @if($lamaranList->isEmpty())
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="mdi mdi-file-document-outline" style="font-size: 64px; color: #ddd;"></i>
                                </div>
                                <h5 class="text-muted">Belum Ada Lamaran</h5>
                                <p class="text-muted">Anda belum melamar pekerjaan apapun. Mulai jelajahi lowongan yang tersedia!</p>
                                <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                                    <i class="mdi mdi-magnify me-1"></i>Cari Lowongan
                                </a>
                            </div>
                            @endif

                            <!-- Pagination -->
                            @if($lamaranList->hasPages())
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $lamaranList->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->

    <script>
        function viewDetails(lowonganId) {
            // Add your logic to view job details
            // This could open a modal or redirect to a detail page
            console.log('View details for job ID:', lowonganId);
        }
    </script>
</div>