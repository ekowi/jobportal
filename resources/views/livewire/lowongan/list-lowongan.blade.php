<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Available Jobs</h5>
                    </div>
                </div>
            </div>

            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Jobnova</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jobs</li>
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
            <div class="row align-items-center">
                <!-- Filter Form -->
                <div class="col-12 mb-4">
                    <div class="card p-4 rounded shadow">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Search</label>
                                    <div class="form-icon position-relative">
                                        <input wire:model="search" type="text" class="form-control ps-5" placeholder="Search job position...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Categories</label>
                                    <select wire:model="selectedCategory" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <select wire:model="selectedLocation" class="form-select">
                                        <option value="">All Locations</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location }}">{{ $location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Job Type</label>
                                    <select wire:model="isRemote" class="form-select">
                                        <option value="">All Types</option>
                                        <option value="1">Remote</option>
                                        <option value="0">On-site</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Salary Range</label>
                                    <select wire:model="salaryRange" class="form-select">
                                        <option value="">All Salary Ranges</option>
                                        @foreach($salaryRanges as $range => $label)
                                            <option value="{{ $range }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 align-self-end">
                                <div class="d-grid">
                                    <button type="button" wire:click="applyFilter" class="btn btn-primary">Apply Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" wire:click="resetFilter" class="btn btn-sm btn-soft-primary">Reset Filter</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Listings -->
                <div class="col-12">
                    @if($lowongans->isEmpty())
                        <div class="alert alert-info">No jobs found matching your criteria.</div>
                    @else
                        @foreach($lowongans as $job)
                            <div class="job-box card rounded shadow border-0 overflow-hidden mb-4">
                                <div class="p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <div class="mb-md-0 mb-3">
                                                <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                    @if($job->kategoriLowongan && $job->kategoriLowongan->logo)
                                                        <img src="{{ asset('storage/image/logo/kategori-lowongan/'.$job->kategoriLowongan->logo) }}" alt="{{ $job->kategoriLowongan->nama_kategori }}" style="max-width: 60px; max-height: 60px;">
                                                    @else
                                                        <i data-feather="award" class="fea icon-md"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-md-0 mb-3">
                                                <h5 class="mb-0 fw-bold"><a href="#" class="text-dark">{{ $job->nama_posisi }}</a></h5>
                                                <p class="text-muted mb-0">{{ $job->kategoriLowongan->nama_kategori ?? 'Uncategorized' }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-md-0 mb-3">
                                                <h6 class="mb-0">{{ $job->lokasi }}</h6>
                                                <p class="text-muted mb-0">{{ $job->is_remote ? 'Remote' : 'On-site' }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-md-0 mb-3">
                                                <h6 class="mb-0">{{ $job->formatted_gaji }} Juta</h6>
                                                <p class="text-muted mb-0">{{ 'Full-time' }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-md-0 mb-3">
                                                {{-- @auth
                                                    <a href="{{ route('kandidat\complete-apply', ['id' => $job->id]) }}" class="btn btn-sm btn-primary">Apply Now</a>
                                                @else --}}
                                                    <a href="{{ route('login', ['redirect' => url()->current(), 'job_id' => $job->id]) }}" class="btn btn-sm btn-primary">Apply Now</a>
                                                {{-- @endauth --}}
                                                <p class="text-muted mb-0 mt-2">{{ $job->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $lowongans->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End -->

    @push('scripts')
    <script>
        if(window.feather) feather.replace();
    </script>
    @endpush
</div>
