<div>
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Manajemen Kandidat</h5>
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
            <!-- Filter dan Pencarian -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari kandidat..." wire:model.live="search">
                        <button class="btn btn-primary" type="button">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel Kandidat -->
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shadow rounded">
                        <table class="table table-center bg-white mb-0">
                            <thead>
                                <tr>
                                    <th class="border-bottom p-3">Nama Lengkap</th>
                                    <th class="border-bottom p-3">No. Telepon</th>
                                    <th class="border-bottom p-3">Email</th>
                                    <th class="border-bottom p-3">Status</th>
                                    <th class="border-bottom p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kandidats as $kandidat)
                                <tr>
                                    <td class="p-3">{{ $kandidat->getFullNameAttribute() }}</td>
                                    <td class="p-3">{{ $kandidat->no_telpon }}</td>
                                    <td class="p-3">{{ $kandidat->user->email }}</td>
                                    <td class="p-3">
                                        <span class="badge bg-soft-success">Aktif</span>
                                    </td>
                                    <td class="p-3">
                                        <button class="btn btn-sm btn-soft-primary me-1" wire:click="showDetail({{ $kandidat->id }})">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-soft-warning me-1" wire:click="edit({{ $kandidat->id }})">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-soft-danger" wire:click="confirmDelete({{ $kandidat->id }})">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center p-3">Tidak ada data kandidat</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $kandidats->links() }}
                    </div>
                </div>
            </div>

            <!-- Modal Detail Kandidat -->
            @if($showDetailModal)
            <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Kandidat</h5>
                            <button type="button" class="btn-close" wire:click="closeModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <p>{{ $selectedKandidat->getFullNameAttribute() }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <p>{{ $selectedKandidat->user->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. Telepon</label>
                                    <p>{{ $selectedKandidat->no_telpon }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. KTP</label>
                                    <p>{{ $selectedKandidat->no_ktp }}</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Alamat</label>
                                    <p>{{ $selectedKandidat->getFormattedAddressAttribute() }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat, Tanggal Lahir</label>
                                    <p>{{ $selectedKandidat->tempat_lahir }}, {{ $selectedKandidat->tanggal_lahir->format('d F Y') }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <p>{{ $selectedKandidat->jenis_kelamin }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Perkawinan</label>
                                    <p>{{ $selectedKandidat->status_perkawinan }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama</label>
                                    <p>{{ $selectedKandidat->agama }}</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Pendidikan</label>
                                    <p>{{ $selectedKandidat->pendidikan }}</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Pengalaman Kerja</label>
                                    <p>{{ $selectedKandidat->pengalaman_kerja }}</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Kemampuan</label>
                                    <p>{{ $selectedKandidat->kemampuan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('confirm-delete', (event) => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data kandidat akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.deleteKandidat();
                }
            });
        });
    });
</script>
@endpush