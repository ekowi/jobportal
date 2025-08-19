<div>
    {{-- Hero Section --}}
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Profil Saya</h5>
                        <p class="text-white-50 para-desc mx-auto mb-0">Lihat dan kelola data diri Anda di sini.</p>
                    </div>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    {{-- Shape Divider --}}
    <div class="position-relative">
        <div class="shape overflow-hidden text-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    {{-- Main Content --}}
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    @if ($kandidat)
                        {{-- Profile Information --}}
                        <div class="card border-0 shadow rounded mb-4">
                            <div class="card-header bg-primary p-4 d-flex justify-content-between align-items-center">
                                <h5 class="card-title text-white mb-0">
                                    <i class="mdi mdi-account-circle-outline me-2"></i>Profile Information
                                </h5>
                                <a href="{{ route('profile.edit') }}#profile-info" class="btn btn-sm btn-light">
                                    <i class="mdi mdi-pencil me-1"></i>Edit
                                </a>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Nama Depan</h6>
                                        <p class="fw-medium">{{ $kandidat->nama_depan }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Nama Tengah</h6>
                                        <p class="fw-medium">{{ $kandidat->nama_tengah ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Nama Belakang</h6>
                                        <p class="fw-medium">{{ $kandidat->nama_belakang }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Alamat Email Pribadi</h6>
                                        <p class="fw-medium">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Nomor Telepon</h6>
                                        <p class="fw-medium">{{ $kandidat->no_telpon }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Nomor Telepon Alternatif</h6>
                                        <p class="fw-medium">{{ $kandidat->no_telpon_alternatif ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Alamat Tempat Tinggal</h6>
                                        <p class="fw-medium">{{ $kandidat->alamat }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Kota</h6>
                                        <p class="fw-medium">{{ $kandidat->kota ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Negara</h6>
                                        <p class="fw-medium">{{ $kandidat->negara }}</p>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <h6 class="text-muted mb-0">Kode Pos</h6>
                                        <p class="fw-medium">{{ $kandidat->kode_pos }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Work Experience --}}
                        <div class="card border-0 shadow rounded mb-4">
                            <div class="card-header bg-primary p-4 d-flex justify-content-between align-items-center">
                                <h5 class="card-title text-white mb-0">
                                    <i class="mdi mdi-briefcase-outline me-2"></i>Riwayat Pengalaman Kerja
                                </h5>
                                <a href="{{ route('profile.edit') }}#work-experience" class="btn btn-sm btn-light">
                                    <i class="mdi mdi-plus me-1"></i>Tambah
                                </a>
                            </div>
                            <div class="card-body p-4">
                                @php $pengalaman = json_decode($kandidat->pengalaman_kerja, true); @endphp
                                @if (is_array($pengalaman) && count($pengalaman))
                                    @foreach ($pengalaman as $exp)
                                        <div class="mb-4">
                                            <h6 class="fw-semibold mb-1">{{ $exp['nama_perusahaan'] ?? '-' }}</h6>
                                            <p class="mb-0"><strong>Tanggal Mulai:</strong> {{ $exp['tanggal_mulai'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Tanggal Terakhir:</strong> {{ $exp['tanggal_selesai'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Keterangan Bisnis:</strong> {{ $exp['keterangan_bisnis'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Jabatan:</strong> {{ $exp['jabatan'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Alasan Keluar/Berhenti:</strong> {{ $exp['alasan_keluar'] ?? '-' }}</p>
                                        </div>
                                    @endforeach
                                @elseif($kandidat->pengalaman_kerja)
                                    <p style="white-space: pre-wrap;">{{ $kandidat->pengalaman_kerja }}</p>
                                @else
                                    <p class="text-muted">Belum ada riwayat pengalaman kerja.</p>
                                @endif
                            </div>
                        </div>

                        {{-- Education History --}}
                        <div class="card border-0 shadow rounded mb-4">
                            <div class="card-header bg-primary p-4 d-flex justify-content-between align-items-center">
                                <h5 class="card-title text-white mb-0">
                                    <i class="mdi mdi-school-outline me-2"></i>Riwayat Pendidikan
                                </h5>
                                <a href="{{ route('profile.edit') }}#education" class="btn btn-sm btn-light">
                                    <i class="mdi mdi-plus me-1"></i>Tambah
                                </a>
                            </div>
                            <div class="card-body p-4">
                                @php $pendidikan = json_decode($kandidat->pendidikan, true); @endphp
                                @if (is_array($pendidikan) && count($pendidikan))
                                    @foreach ($pendidikan as $edu)
                                        <div class="mb-4">
                                            <h6 class="fw-semibold mb-1">{{ $edu['nama_pendidikan'] ?? '-' }}</h6>
                                            <p class="mb-0"><strong>Jurusan:</strong> {{ $edu['jurusan'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Tingkat Pendidikan:</strong> {{ $edu['tingkat'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Pendidikan Tertinggi:</strong> {{ $edu['pendidikan_tertinggi'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Tanggal Mulai:</strong> {{ $edu['tanggal_mulai'] ?? '-' }}</p>
                                            <p class="mb-0"><strong>Tanggal Berakhir:</strong> {{ $edu['tanggal_selesai'] ?? '-' }}</p>
                                        </div>
                                    @endforeach
                                @elseif($kandidat->pendidikan)
                                    <p>{{ $kandidat->pendidikan }}</p>
                                @else
                                    <p class="text-muted">Belum ada riwayat pendidikan.</p>
                                @endif
                            </div>
                        </div>

                        {{-- Language Skills --}}
                        <div class="card border-0 shadow rounded mb-4">
                            <div class="card-header bg-primary p-4 d-flex justify-content-between align-items-center">
                                <h5 class="card-title text-white mb-0">
                                    <i class="mdi mdi-translate me-2"></i>Keterampilan Bahasa
                                </h5>
                                <a href="{{ route('profile.edit') }}#language" class="btn btn-sm btn-light">
                                    <i class="mdi mdi-plus me-1"></i>Tambah
                                </a>
                            </div>
                            <div class="card-body p-4">
                                @php $bahasa = json_decode($kandidat->kemampuan_bahasa, true); @endphp
                                @if (is_array($bahasa) && count($bahasa))
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Bahasa</th>
                                                    <th>Berbicara</th>
                                                    <th>Membaca</th>
                                                    <th>Menulis</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bahasa as $lang)
                                                    <tr>
                                                        <td>{{ $lang['bahasa'] ?? '-' }}</td>
                                                        <td>{{ $lang['bicara'] ?? '-' }}</td>
                                                        <td>{{ $lang['membaca'] ?? '-' }}</td>
                                                        <td>{{ $lang['menulis'] ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @elseif($kandidat->kemampuan_bahasa)
                                    <p style="white-space: pre-wrap;">{{ $kandidat->kemampuan_bahasa }}</p>
                                @else
                                    <p class="text-muted">Belum ada data kemampuan bahasa.</p>
                                @endif
                            </div>
                        </div>

                        {{-- Specific Information --}}
                        <div class="card border-0 shadow rounded">
                            <div class="card-header bg-primary p-4 d-flex justify-content-between align-items-center">
                                <h5 class="card-title text-white mb-0">
                                    <i class="mdi mdi-information-outline me-2"></i>Informasi Spesifik
                                </h5>
                                <a href="{{ route('profile.edit') }}#specific-info" class="btn btn-sm btn-light">
                                    <i class="mdi mdi-pencil me-1"></i>Edit
                                </a>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Pernah bekerja di perusahaan ini?</h6>
                                        <p class="fw-medium">{{ $kandidat->pernah_bekerja ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Lokasi bekerja sebelumnya</h6>
                                        <p class="fw-medium">{{ $kandidat->lokasi_bekerja ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-0">Sumber informasi pekerjaan ini</h6>
                                        <p class="fw-medium">{{ $kandidat->sumber_informasi ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <h6 class="text-muted mb-0">Identifikasi jenis kelamin</h6>
                                        <p class="fw-medium">{{ $kandidat->jenis_kelamin == 'L' ? 'Laki-laki' : ($kandidat->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Pesan jika profil belum lengkap --}}
                        <div class="card border-0 shadow rounded">
                            <div class="card-body text-center py-5">
                                <i class="mdi mdi-information-outline mdi-48px text-warning"></i>
                                <h5 class="mt-3">Profil Anda Belum Lengkap</h5>
                                <p class="text-muted">Silakan lengkapi profil Anda untuk melanjutkan proses rekrutmen.</p>
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-2">
                                    <i class="mdi mdi-pencil me-1"></i>Lengkapi Profil Sekarang
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>