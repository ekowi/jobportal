<div>
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
    <section class="bg-half-170 d-table w-100" style="background: url('images/hero/bg.jpg');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Bank Soal</h5>
                    </div>
                </div>
            </div>

            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bank Soal</li>
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
        <div class="container mt-100">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title mb-4">Bank Soal</h4>
                        <p class="text-muted para-desc mx-auto mb-0">Kelola daftar soal untuk tes kandidat</p>
                    </div>
                </div>
            </div>

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
                                                    placeholder="Cari soal...">
                                                <span class="search-icon">
                                                    <i class="mdi mdi-magnify"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button wire:click="create" class="btn btn-primary">
                                        <i class="mdi mdi-plus"></i> Tambah Soal
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">Soal</th>
                                            <th class="border-bottom p-3">Kategori</th>
                                            <th class="border-bottom p-3">pilihan 1</th>
                                            <th class="border-bottom p-3">pilihan 2</th>
                                            <th class="border-bottom p-3">pilihan 3</th>
                                            <th class="border-bottom p-3">pilihan 4</th>
                                            <th class="border-bottom p-3">Jawaban Benar</th>
                                            <th class="border-bottom p-3">Status</th>
                                            <th class="border-bottom p-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($soals as $soal)
                                        <tr>
                                            <td class="p-3">{{ Str::limit($soal->soal, 50) }}</td>
                                            <td class="p-3">{{ $soal->kategori->nama_kategori }}</td>
                                            <td class="p-3">{{ $soal->pilihan_1 }}</td>
                                            <td class="p-3">{{ $soal->pilihan_2 }}</td>
                                            <td class="p-3">{{ $soal->pilihan_3 }}</td>
                                            <td class="p-3">{{ $soal->pilihan_4 }}</td>
                                            <td class="p-3">{{ Str::limit($soal->jawaban_benar_text, 30) }}</td>
                                            <td class="p-3">
                                                <span class="badge bg-{{ $soal->status ? 'success' : 'danger' }}">
                                                    {{ $soal->status ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td class="p-3">
                                                <button wire:click="edit({{ $soal->id_soal }})" 
                                                    class="btn btn-sm btn-primary me-2">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button wire:click="delete({{ $soal->id_soal }})" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus soal ini?')">
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
                                {{ $soals->links() }}
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
    <div class="modal fade show" style="display: block">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $soalId ? 'Edit Soal' : 'Tambah Soal' }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kategori Soal</label>
                            <select wire:model="id_kategori_soal" class="form-select">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoriSoals as $kategori)
                                    <option value="{{ $kategori->id_kategori_soal }}">
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori_soal') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Soal</label>
                            <textarea wire:model="soal" class="form-control" rows="3"></textarea>
                            @error('soal') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilihan 1</label>
                            <input type="text" wire:model="pilihan_1" class="form-control">
                            @error('pilihan_1') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilihan 2</label>
                            <input type="text" wire:model="pilihan_2" class="form-control">
                            @error('pilihan_2') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilihan 3</label>
                            <input type="text" wire:model="pilihan_3" class="form-control">
                            @error('pilihan_3') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilihan 4</label>
                            <input type="text" wire:model="pilihan_4" class="form-control">
                            @error('pilihan_4') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jawaban Benar</label>
                            <select wire:model="jawaban" class="form-select @error('jawaban') is-invalid @enderror">
                                <option value="">Pilih Jawaban Benar</option>
                                <option value="1">Pilihan 1</option>
                                <option value="2">Pilihan 2</option>
                                <option value="3">Pilihan 3</option>
                                <option value="4">Pilihan 4</option>
                            </select>
                            @error('id_kategori_jawaban') 
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
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        /* Improved search box styling */
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

        /* Modal backdrop styles */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Fix for scrollbar jump when modal opens */
        body.modal-open {
            padding-right: 0 !important;
            overflow-y: auto;
        }
    </style>
    @endif
</div>