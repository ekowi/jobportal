<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Riwayat Pengalaman Kerja</h5>
                        <p class="text-white-50 para-desc mx-auto mb-0">Tambah atau perbarui pengalaman kerja Anda.</p>
                    </div>
                </div>
            </div>
            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Pengalaman Kerja</li>
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
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-header bg-primary p-4">
                            <h5 class="card-title text-white mb-0">
                                <i class="mdi mdi-briefcase-outline me-2"></i>Pengalaman Kerja
                            </h5>
                            <p class="text-white-50 mb-0 mt-1">Tambah atau perbarui pengalaman kerja Anda.</p>
                        </div>
                        <form class="card-body p-4">
                            <div id="experience-container">
                                <div class="row g-3 border rounded p-3 mb-3 experience-item">
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Mulai Bekerja</label>
                                        <input type="date" class="form-control" name="start[]">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Terakhir Bekerja</label>
                                        <input type="date" class="form-control" name="end[]">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" name="company[]" placeholder="Nama Perusahaan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Keterangan Bisnis Perusahaan</label>
                                        <input type="text" class="form-control" name="business[]" placeholder="Keterangan Bisnis">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" class="form-control" name="position[]" placeholder="Jabatan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alasan Keluar/Berhenti</label>
                                        <input type="text" class="form-control" name="reason[]" placeholder="Alasan Keluar">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addExperience()">
                                <i class="mdi mdi-plus me-1"></i>Tambah Pengalaman
                            </button>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
function addExperience() {
    const container = document.getElementById('experience-container');
    const item = container.querySelector('.experience-item').cloneNode(true);
    item.querySelectorAll('input').forEach(input => input.value = '');
    container.appendChild(item);
}
</script>
