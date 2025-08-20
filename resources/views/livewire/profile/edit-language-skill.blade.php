<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Keterampilan Bahasa</h5>
                        <p class="text-white-50 para-desc mx-auto mb-0">Tambah atau perbarui keterampilan bahasa Anda.</p>
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
                            <h5 class="card-title text-white mb-0">Keterampilan Bahasa</h5>
                        </div>
                        <form class="card-body p-4">
                            <div id="language-container">
                                <div class="row g-3 border rounded p-3 mb-3 language-item">
                                    <div class="col-md-3">
                                        <label class="form-label">Bahasa</label>
                                        <select class="form-select" name="language[]">
                                            <option value="">Pilih Bahasa</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Inggris">Inggris</option>
                                            <option value="Jepang">Jepang</option>
                                            <option value="Mandarin">Mandarin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Kemahiran Berbicara</label>
                                        <select class="form-select" name="speak[]">
                                            <option value="Dasar">Dasar</option>
                                            <option value="Menengah">Menengah</option>
                                            <option value="Mahir">Mahir</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Kemahiran Membaca</label>
                                        <select class="form-select" name="read[]">
                                            <option value="Dasar">Dasar</option>
                                            <option value="Menengah">Menengah</option>
                                            <option value="Mahir">Mahir</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Kemahiran Menulis</label>
                                        <select class="form-select" name="write[]">
                                            <option value="Dasar">Dasar</option>
                                            <option value="Menengah">Menengah</option>
                                            <option value="Mahir">Mahir</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addLanguage()">
                                <i class="mdi mdi-plus me-1"></i>Tambah Bahasa
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
function addLanguage() {
    const container = document.getElementById('language-container');
    const item = container.querySelector('.language-item').cloneNode(true);
    item.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
    container.appendChild(item);
}
</script>
