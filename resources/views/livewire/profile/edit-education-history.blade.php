<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Riwayat Pendidikan</h5>
                        <p class="text-white-50 para-desc mx-auto mb-0">Tambah atau perbarui riwayat pendidikan Anda.</p>
                    </div>
                </div>
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
                            <h5 class="card-title text-white mb-0">Riwayat Pendidikan</h5>
                        </div>
                        <form class="card-body p-4">
                            <div id="education-container">
                                <div class="row g-3 border rounded p-3 mb-3 education-item">
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Mulai Pendidikan</label>
                                        <input type="date" class="form-control" name="edu_start[]">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Berakhir Pendidikan</label>
                                        <input type="date" class="form-control" name="edu_end[]">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Pendidikan</label>
                                        <input type="text" class="form-control" name="edu_name[]" placeholder="Nama Institusi">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jurusan</label>
                                        <input type="text" class="form-control" name="major[]" placeholder="Jurusan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tingkat Pendidikan</label>
                                        <input type="text" class="form-control" name="level[]" placeholder="Tingkat Pendidikan">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" name="highest[]">
                                            <label class="form-check-label">Pendidikan Tertinggi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addEducation()">
                                <i class="mdi mdi-plus me-1"></i>Tambah Pendidikan
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
function addEducation() {
    const container = document.getElementById('education-container');
    const item = container.querySelector('.education-item').cloneNode(true);
    item.querySelectorAll('input').forEach(input => {
        if (input.type === 'checkbox') {
            input.checked = false;
        } else {
            input.value = '';
        }
    });
    container.appendChild(item);
}
</script>
