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

                                                {{-- Tombol reset --}}
                                                @if($search)
                                                    <button wire:click="$set('search', '')" 
                                                            class="btn btn-outline-secondary btn-sm position-absolute" 
                                                            style="right: 35px; top: 50%; transform: translateY(-50%); z-index: 3;">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                @endif
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
                                            <th class="border-bottom p-3 text-nowrap text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($soals as $soal)
                                        <tr>
                                            <td class="p-3">
                                                @if($soal->type_soal_id == 2)
                                                    <img src="{{ Storage::url($soal->soal) }}" class="img-fluid" style="max-height: 50px">
                                                @else
                                                    {{ Str::limit($soal->soal, 50) }}
                                                @endif
                                            </td>
                                            <td class="p-3">{{ $soal->kategori->nama_kategori }}</td>
                                            <td class="p-3">
                                                @if($soal->type_jawaban_id == 2)
                                                    <img src="{{ Storage::url($soal->pilihan_1) }}" class="img-fluid" style="max-height: 30px">
                                                @else
                                                    {{ Str::limit($soal->pilihan_1, 30) }}
                                                @endif
                                            </td>
                                            <td class="p-3">
                                                @if($soal->type_jawaban_id == 2)
                                                    <img src="{{ Storage::url($soal->pilihan_2) }}" class="img-fluid" style="max-height: 30px">
                                                @else
                                                    {{ Str::limit($soal->pilihan_2, 30) }}
                                                @endif
                                            </td>
                                            <td class="p-3">
                                                @if($soal->type_jawaban_id == 2)
                                                    <img src="{{ Storage::url($soal->pilihan_3) }}" class="img-fluid" style="max-height: 30px">
                                                @else
                                                    {{ Str::limit($soal->pilihan_3, 30) }}
                                                @endif
                                            </td>
                                            <td class="p-3">
                                                @if($soal->type_jawaban_id == 2)
                                                    <img src="{{ Storage::url($soal->pilihan_4) }}" class="img-fluid" style="max-height: 30px">
                                                @else
                                                    {{ Str::limit($soal->pilihan_4, 30) }}
                                                @endif
                                            </td>
                                            <td class="p-3">
                                                @if($soal->type_jawaban_id == 2)
                                                    <img src="{{ Storage::url($soal->jawaban_benar_text) }}" class="img-fluid" style="max-height: 30px">
                                                @else
                                                    {{ Str::limit($soal->jawaban_benar_text, 30) }}
                                                @endif
                                            </td>
                                            <td class="p-3">
                                                <span class="badge bg-{{ $soal->status ? 'success' : 'danger' }}">
                                                    {{ $soal->status ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-center text-nowrap">
                                                <div class="btn-group" role="group">
                                                    <button wire:click="edit({{ $soal->id_soal }})" 
                                                            class="btn btn-sm btn-primary">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button wire:click="delete({{ $soal->id_soal }})" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus soal ini?')">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center p-3">Tidak ada data</td>
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

                        <!-- Tipe Soal dropdown with immediate update -->
                        <div class="mb-3">
                            <label class="form-label">Tipe Soal</label>
                            <select wire:model="type_soal_id" class="form-select">
                                <option value="">Pilih Tipe Soal</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->nama }}</option>
                                @endforeach
                            </select>
                            @error('type_soal_id') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <!-- Dynamic input based on type -->
                        <div class="mb-3">
                            <label class="form-label">Soal</label>
                            <div x-data="{ 
                                type: @entangle('type_soal_id'),
                                preview: null,
                                init() {
                                    this.$watch('type', value => {
                                        this.preview = null;
                                    })
                                }
                            }">
                                <div x-show="type == 2" x-transition:enter="transition ease-out duration-300">
                                    <div class="mb-2">
                                        <input type="file" 
                                            wire:model="soal" 
                                            class="form-control" 
                                            accept="image/*"
                                            x-ref="fileInput"
                                            @change="preview = URL.createObjectURL($event.target.files[0])">
                                    </div>
                                    <!-- Image Preview -->
                                    <template x-if="preview || '{{ is_string($soal) && Str::startsWith($soal, "soal-images") }}'">
                                        <div class="mt-2">
                                            <img x-show="preview" :src="preview" class="img-preview" style="max-height: 200px">
                                            @if(is_string($soal) && Str::startsWith($soal, 'soal-images'))
                                                <img src="{{ Storage::url($soal) }}" class="img-preview" style="max-height: 200px">
                                            @endif
                                        </div>
                                    </template>
                                </div>
                                <div x-show="type != 2" x-transition:enter="transition ease-out duration-300">
                                    <textarea 
                                        wire:model="soal" 
                                        class="form-control" 
                                        rows="3"
                                        placeholder="Masukkan soal disini..."></textarea>
                                </div>
                            </div>
                            @error('soal') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <!-- Type Jawaban dropdown -->
                        <div class="mb-3">
                            <label class="form-label">Tipe Jawaban</label>
                            <select wire:model="type_jawaban_id" class="form-select">
                                <option value="">Pilih Tipe Jawaban</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->nama }}</option>
                                @endforeach
                            </select>
                            @error('type_jawaban_id') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>

                        <!-- Dynamic answer inputs -->
                        <div x-data="{ 
                            typeJawaban: @entangle('type_jawaban_id'),
                            previews: {
                                pilihan_1: null,
                                pilihan_2: null,
                                pilihan_3: null,
                                pilihan_4: null
                            },
                            init() {
                                this.$watch('typeJawaban', value => {
                                    this.previews = {
                                        pilihan_1: null,
                                        pilihan_2: null,
                                        pilihan_3: null,
                                        pilihan_4: null
                                    };
                                })
                            }
                        }">
                            @for($i = 1; $i <= 4; $i++)
                                <div class="mb-3">
                                    <label class="form-label">Pilihan {{ $i }}</label>
                                    <div x-show="typeJawaban == 2" x-transition:enter="transition ease-out duration-300">
                                        <div class="mb-2">
                                            <input type="file" 
                                                wire:model="pilihan_{{ $i }}" 
                                                class="form-control" 
                                                accept="image/*"
                                                @change="previews.pilihan_{{ $i }} = URL.createObjectURL($event.target.files[0])">
                                        </div>
                                        <!-- Image Preview -->
                                        <template x-if="previews.pilihan_{{ $i }} || '{{ is_string(${'pilihan_'.$i}) && Str::startsWith(${'pilihan_'.$i}, "jawaban-images") }}'">
                                            <div class="mt-2">
                                                <img x-show="previews.pilihan_{{ $i }}" 
                                                    :src="previews.pilihan_{{ $i }}" 
                                                    class="img-preview" 
                                                    style="max-height: 100px">
                                                @if(is_string(${'pilihan_'.$i}) && Str::startsWith(${'pilihan_'.$i}, 'jawaban-images'))
                                                    <img src="{{ Storage::url(${'pilihan_'.$i}) }}" 
                                                        class="img-preview" 
                                                        style="max-height: 100px">
                                                @endif
                                            </div>
                                        </template>
                                    </div>
                                    <div x-show="typeJawaban != 2" x-transition:enter="transition ease-out duration-300">
                                        <input type="text" 
                                            wire:model="pilihan_{{ $i }}" 
                                            class="form-control"
                                            placeholder="Masukkan pilihan {{ $i }}">
                                    </div>
                                    @error('pilihan_'.$i) 
                                        <div class="text-danger small">{{ $message }}</div> 
                                    @enderror
                                </div>
                            @endfor
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
    
        /* Image preview styling */
        .img-preview {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 3px;
            background-color: #fff;
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    
        /* Table image styling */
        .table img {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            background-color: #fff;
            object-fit: contain;
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

        /* Add these to your existing styles */
        .transition {
            transition-property: opacity, transform;
        }
        
        .duration-300 {
            transition-duration: 300ms;
        }
        
        .ease-out {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* File input styling */
        input[type="file"] {
            padding: 0.375rem 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            background-color: #fff;
            width: 100%;
        }

        input[type="file"]::-webkit-file-upload-button {
            background-color: #6c757d;
            color: white;
            padding: 0.375rem 0.75rem;
            border: none;
            border-radius: 0.25rem;
            margin-right: 0.75rem;
            cursor: pointer;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background-color: #5a6268;
        }

        /* Preview container */
        .preview-container {
            position: relative;
            margin-top: 0.5rem;
        }

        /* Preview remove button */
        .preview-remove {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }

        /* Image preview transition */
        .preview-enter {
            opacity: 0;
            transform: scale(0.9);
        }
        
        .preview-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 300ms, transform 300ms;
        }
        
        .preview-exit {
            opacity: 1;
            transform: scale(1);
        }
        
        .preview-exit-active {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 300ms, transform 300ms;
        }
    </style>
    @endif
</div>