@include('partials.head', ['title' => 'Browse Jobs - Job Portal MTU'])

<body>
    @include('partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <section class="py-5 bg-light">
            <div class="container">
                <h3 class="text-center mb-4">Available Jobs</h3>
                <div class="row">
                    @forelse($jobs as $job)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($job->foto)
                                    <img src="{{ asset('storage/image/lowongan/' . $job->foto) }}" class="card-img-top" alt="{{ $job->nama_posisi }}">
                                @else
                                    <img src="{{ asset('images/error.png') }}" class="card-img-top" alt="{{ $job->nama_posisi }}">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $job->nama_posisi }}</h5>
                                    <p class="text-muted mb-1">{{ $job->kategoriLowongan->nama_kategori ?? 'Uncategorized' }}</p>
                                    <p class="text-muted mb-1"><i data-feather="map-pin" class="align-text-bottom me-1"></i>{{ $job->lokasi_penugasan }} - {{ $job->is_remote ? 'Remote' : 'On-site' }}</p>
                                    <p class="text-muted mb-2"><i data-feather="dollar-sign" class="align-text-bottom me-1"></i>{{ $job->formatted_gaji }}</p>
                                    <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit($job->deskripsi, 120) }}</p>
                                    <a href="{{ route('login', ['redirect' => url()->current(), 'job_id' => $job->id]) }}" class="btn btn-primary mt-auto">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">No jobs available at the moment.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    @include('partials.footer')

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top rounded fs-5">
        <i data-feather="arrow-up" class="fea icon-sm align-middle"></i>
    </a>

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/choices.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <!-- Custom -->
    <script src="{{ asset('js/plugins.init.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        if(window.feather) feather.replace();
    </script>
</body>
</html>
