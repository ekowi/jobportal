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
                    <div class="card border-0 rounded shadow">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Officer List</h5>
                            <a href="#" class="btn btn-primary btn-sm">Add New Officer</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">#</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIK</th>
                                            <th>Jabatan</th>
                                            <th>DOH</th>
                                            <th>Lokasi Penugasan</th>
                                            <th class="text-center" style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse($officers ?? [] as $index => $officer)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $officer->nama_lengkap ?? 'John Doe' }}</td>
                                                <td>{{ $officer->nik ?? '3174071234560001' }}</td>
                                                <td>{{ $officer->jabatan ?? 'Senior Officer' }}</td>
                                                <td>{{ $officer->doh ?? '2023-05-15' }}</td>
                                                <td>{{ $officer->lokasi_penugasan ?? 'Jakarta' }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <div class="py-4">
                                                        <img src="{{ asset('images/empty.svg') }}" alt="No Data" class="img-fluid" style="max-height: 120px;">
                                                        <p class="text-muted my-3">No officer records found</p>
                                                        <a href="#" class="btn btn-sm btn-primary">Add Your First Officer</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse --}}

                                        <!-- Sample Data (Remove in production) -->
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Ahmad Sulaiman</td>
                                            <td>3174071205890002</td>
                                            <td>Senior Officer</td>
                                            <td>2022-01-15</td>
                                            <td>Jakarta Pusat</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Budi Santoso</td>
                                            <td>3174071509870003</td>
                                            <td>Team Leader</td>
                                            <td>2021-08-22</td>
                                            <td>Bandung</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Clara Dewi</td>
                                            <td>3174071103920004</td>
                                            <td>Junior Officer</td>
                                            <td>2023-03-10</td>
                                            <td>Surabaya</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- End Sample Data -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <ul class="pagination justify-content-center mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true"><i class="mdi mdi-chevron-left fs-6"></i></span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true"><i class="mdi mdi-chevron-right fs-6"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
