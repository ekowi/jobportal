<div> <!-- [1] Div pembungkus utama untuk menghindari error Livewire -->

    <!-- Notification Area -->
    <div style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 300px;">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Kategori Soal</h5>
                    </div>
                </div>
            </div>

            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('officers.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori Soal</li>
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

    <!-- Content Start -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card border-0 rounded shadow">
                        <div class="card-body">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-6">
                                    <div class="search-bar">
                                        <div id="search" class="menu-search mb-0">
                                            <div class="search-box">
                                                <input wire:model.debounce.300ms="search" type="text" 
                                                    class="form-control border rounded" 
                                                    placeholder="Cari kategori...">
                                                <span class="search-icon">
                                                    <i class="mdi mdi-magnify"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button wire:click="create" class="btn btn-primary">
                                        <i class="mdi mdi-plus"></i> Tambah Kategori
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">Nama Kategori</th>
                                            <th class="border-bottom p-3">Deskripsi</th>
                                            <th class="border-bottom p-3">Status</th>
                                            <th class="border-bottom p-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kategoris as $kategori)
                                        <tr>
                                            <td class="p-3">{{ $kategori->nama_kategori }}</td>
                                            <td class="p-3">{{ Str::limit($kategori->deskripsi, 70) }}</td>
                                            <td class="p-3">
                                                <span class="badge bg-{{ $kategori->status ? 'success' : 'danger' }}">
                                                    {{ $kategori->status ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td class="p-3">
                                                <button wire:click="edit({{ $kategori->id_kategori_soal }})" 
                                                        class="btn btn-sm btn-primary me-2">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button wire:click="delete({{ $kategori->id_kategori_soal }})" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    <i class="mdi mdi-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center p-3">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $kategoris->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content End -->

    <!-- Modal Form -->
    @if($showModal)
    <div class="modal fade show" style="display: block; padding-right: 0px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $kategoriId ? 'Edit Kategori' : 'Tambah Kategori' }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" wire:model="nama_kategori" class="form-control">
                            @error('nama_kategori') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea wire:model="deskripsi" class="form-control" rows="3"></textarea>
                            @error('deskripsi') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" wire:model="status" 
                                       class="form-check-input" id="statusCheck">
                                <label class="form-check-label" for="statusCheck">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" 
                                wire:click="$set('showModal', false)">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    @push('styles')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        .search-box {
            position: relative;
        }
        .search-box .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .search-box input {
            padding-right: 30px;
        }
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }
        body.modal-open {
            padding-right: 0 !important;
            overflow-y: auto;
        }
    </style>
    @endpush

</div>