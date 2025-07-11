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
                            <h5 class="card-title mb-0">{{ __('Officer List') }}</h5>
                            <a href="#" wire:click.prevent="openCreateModal" class="btn btn-primary btn-sm">{{ __('Add New Officer') }}</a>
                        </div>
                        <!-- Filter Section -->
                       <div class="card-body border-bottom">
                            <div class="row g-3">
                                <div class="col-lg-3 col-md-6">
                                    <div class="search-box">
                                        <input wire:model.defer="search" type="text" class="form-control" placeholder="Search name, NIK..." />
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <select wire:model.defer="jabatanFilter" class="form-select">
                                        <option value="">{{ __('All Positions') }}</option>
                                        @foreach($positions ?? [] as $position)
                                            <option value="{{ $position }}">{{ $position }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <select wire:model.defer="lokasiFilter" class="form-select">
                                        <option value="">{{ __('All Locations') }}</option>
                                        @foreach($locations ?? [] as $location)
                                            <option value="{{ $location }}">{{ $location }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-6 d-flex">
                                    <button wire:click="applyFilters" class="btn btn-primary me-2">
                                        <i class="mdi mdi-filter-outline me-1"></i> {{ __('Apply') }}
                                    </button>
                                    <button wire:click="resetFilters" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-refresh me-1"></i> {{ __('Reset') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">#</th>
                                            <th wire:click="sortBy('nama_depan')" class="cursor-pointer">
                                                {{ __('Full Name') }}
                                                @if($sortField === 'nama_depan')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                                @endif
                                            </th>
                                            <th wire:click="sortBy('nik')" class="cursor-pointer">
                                                {{ __('NIK') }}
                                                @if($sortField === 'nik')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                                @endif
                                            </th>
                                            <th wire:click="sortBy('jabatan')" class="cursor-pointer">
                                                {{ __('Position') }}
                                                @if($sortField === 'jabatan')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                                @endif
                                            </th>
                                            <th wire:click="sortBy('doh')" class="cursor-pointer">
                                                {{ __('DOH') }}
                                                @if($sortField === 'doh')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                                @endif
                                            </th>
                                            <th wire:click="sortBy('lokasi_penugasan')" class="cursor-pointer">
                                                {{ __('Location') }}
                                                @if($sortField === 'lokasi_penugasan')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                                @endif
                                            </th>
                                            <th class="text-center" style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($officers ?? [] as $index => $officer)
                                            <tr>
                                                <td class="text-center">{{ $officers->firstItem() + $index }}</td>
                                                <td>{{ $officer->nama_depan . ' ' . $officer->nama_belakang }}</td>
                                                <td>{{ $officer->nik }}</td>
                                                <td>{{ $officer->jabatan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($officer->doh)->format('d M Y') }}</td>
                                                <td>{{ $officer->lokasi_penugasan }}</td>
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
                                                        <p class="text-muted my-3">{{ __('No officer records found') }}</p>
                                                        <a href="#" class="btn btn-sm btn-primary">{{ __('Add Your First Officer') }}</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    {{ $officers->links() }}
                                </div>
                            </div>

                            <!-- Create Officer Modal -->
                            <div class="modal fade @if($showCreateModal) show @endif" id="createOfficerModal" tabindex="-1" role="dialog" aria-labelledby="createOfficerModalTitle" @if($showCreateModal) style="display: block; background-color: rgba(0, 0, 0, 0.5);" @else style="display: none;" @endif>
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createOfficerModalTitle">
                                                <i class="mdi mdi-account-plus me-1"></i> {{ __('Add New Officer') }}
                                            </h5>
                                            <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                                        </div>
                                        <!-- Errors Notifications -->
                                        @if (session()->has('success'))
                                            <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if (session()->has('error'))
                                            <div class="alert alert-danger alert-dismissible fade show mx-4 mt-3" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <!-- End Errors Notifications -->
                                        <form wire:submit.prevent="createOfficer">
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('First Name') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('officerData.nama_depan') is-invalid @enderror"
                                                            wire:model.defer="officerData.nama_depan" placeholder="First Name">
                                                        @error('officerData.nama_depan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('Last Name') }}</label>
                                                        <input type="text" class="form-control @error('officerData.nama_belakang') is-invalid @enderror"
                                                            wire:model.defer="officerData.nama_belakang" placeholder="Last Name">
                                                        @error('officerData.nama_belakang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('NIK') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('officerData.nik') is-invalid @enderror"
                                                            wire:model.defer="officerData.nik" placeholder="NIK">
                                                        @error('officerData.nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('Position') }} <span class="text-danger">*</span></label>
                                                        <select class="form-select @error('officerData.jabatan') is-invalid @enderror"
                                                                wire:model.defer="officerData.jabatan">
                                                            <option value="">{{ __('Select Position') }}</option>
                                                            @foreach($positions ?? [] as $position)
                                                                <option value="{{ $position }}">{{ $position }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('officerData.jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Date of Hire <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control @error('officerData.doh') is-invalid @enderror"
                                                            wire:model.defer="officerData.doh">
                                                        @error('officerData.doh') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('Assignment Location') }} <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <select class="form-select @error('selectedLocation') is-invalid @enderror @error('officerData.lokasi_penugasan') is-invalid @enderror"
                                                                wire:model.defer="selectedLocation">
                                                                <option value="">{{ __('Select Location') }}</option>
                                                                @foreach($locations ?? [] as $location)
                                                                    <option value="{{ $location }}">{{ $location }}</option>
                                                                @endforeach
                                                                <option value="custom">{{ __('Add New Location...') }}</option>
                                                            </select>
                                                            @error('selectedLocation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                            @error('officerData.lokasi_penugasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Custom Location Input (shows only when "Add New Location" is selected) -->
                                                    <div class="col-md-6" x-data="{}" x-show="$wire.selectedLocation === 'custom'">
                                                        <label class="form-label">{{ __('New Location Name') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('newLocationName') is-invalid @enderror"
                                                            wire:model.defer="newLocationName" placeholder="{{ __('Enter new location name') }}">
                                                        @error('newLocationName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('Area') }} <span class="text-danger">*</span></label>
                                                        <select class="form-select @error('officerData.area') is-invalid @enderror"
                                                                wire:model.defer="officerData.area">
                                                            <option value="">{{ __('Select Area') }}</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                        @error('officerData.area') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('Supervisor') }}</label>
                                                        <select class="form-select @error('officerData.atasan_id') is-invalid @enderror"
                                                                wire:model.defer="officerData.atasan_id">
                                                            <option value="">{{ __('No Supervisor (Top Level)') }}</option>
                                                            @foreach($supervisors ?? [] as $supervisor)
                                                                <option value="{{ $supervisor->user_id }}">{{ $supervisor->nama_depan . ' ' . $supervisor->nama_belakang }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('officerData.atasan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>

                                                    <hr class="my-3">
                                                    <h6 class="fw-bold">{{ __('User Account Information') }}</h6>

                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control @error('userData.email') is-invalid @enderror"
                                                            wire:model.defer="userData.email" placeholder="{{ __('Email') }}">
                                                        @error('userData.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control @error('userData.password') is-invalid @enderror"
                                                            wire:model.defer="userData.password" placeholder="{{ __('Password') }}">
                                                        @error('userData.password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" wire:click="closeModal">{{ __('Cancel') }}</button>
                                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="createOfficer" class="spinner-border spinner-border-sm me-1"></span>
                                                    {{ __('Create Officer') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
</div>
