<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Job Categories</h5>
                    </div>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Jobnova</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
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
            <div class="row row-cols-lg-5 row-col-md-4 row-cols-sm-2 row-cols-1 g-4">
                @foreach($kategoris as $kategori)
                <div class="col">
                    <div class="position-relative job-category text-center px-4 py-5 rounded shadow">
                        <div class="feature-icon bg-soft-primary rounded shadow mx-auto position-relative overflow-hidden d-flex justify-content-center align-items-center" style="width:64px;height:64px;">
                            @if($kategori->logo)
                                <img src="{{ asset('storage/image/logo/kategori-lowongan/'.$kategori->logo) }}" alt="{{ $kategori->nama_kategori }}" style="max-width:48px;max-height:48px;">
                            @else
                                <i data-feather="award" class="fea icon-ex-md"></i>
                            @endif
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('lowongan.list', ['selectedCategory' => $kategori->id]) }}" class="title h5 text-dark">{{ $kategori->nama_kategori }}</a>
                            <p class="text-muted mb-0 mt-3">{{ $kategori->lowongans_count }} Jobs</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @push('scripts')
    <script>
        if(window.feather) feather.replace();
    </script>
    @endpush
</div>
