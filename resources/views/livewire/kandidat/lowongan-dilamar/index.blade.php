<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Daftar lowongan</h5>
                    </div>
                </div>
            </div>

            <div class="position-middle-bottom">
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb breadcrumb-muted mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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

    <!-- Start -->
    <section class="section">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-12 md:col-span-12">
                    <div class="grid grid-cols-1 gap-[30px]">
                        <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                            <div class="mb-4">
                                <input type="text" wire:model.debounce.300ms="search" 
                                    class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0" 
                                    placeholder="Cari berdasarkan nama posisi...">
                            </div>

                            <div class="mb-4">
                                <select wire:model="status" class="form-select w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="interview">Interview</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>

                            @foreach($lamaranList as $lowongan)
                            <div class="group relative bg-white dark:bg-slate-900 shadow hover:shadow-md dark:shadow-gray-800 dark:hover:shadow-gray-800 overflow-hidden rounded-md transition-all duration-500 ease-in-out mt-4">
                                <div class="p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            @if($lowongan->foto)
                                                <img src="{{ asset('storage/' . $lowongan->foto) }}" class="h-12 w-12 rounded-md p-2 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800" alt="">
                                            @else
                                                <div class="h-12 w-12 rounded-md p-2 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 flex items-center justify-center">
                                                    <i class="mdi mdi-briefcase-outline text-3xl"></i>
                                                </div>
                                            @endif
                                            <div class="ml-3">
                                                <h5 class="mb-1">
                                                    <span class="text-lg font-semibold">{{ $lowongan->nama_posisi }}</span>
                                                </h5>
                                                <span class="text-slate-400 font-medium">{{ $lowongan->departemen }}</span>
                                            </div>
                                        </div>
                                        <span class="bg-{{ $lowongan->pivot->status === 'diterima' ? 'emerald' : ($lowongan->pivot->status === 'ditolak' ? 'red' : 'amber') }}-500/20 inline-block text-{{ $lowongan->pivot->status === 'diterima' ? 'emerald' : ($lowongan->pivot->status === 'ditolak' ? 'red' : 'amber') }}-500 px-3 py-1 rounded-full">
                                            {{ ucfirst($lowongan->pivot->status) }}
                                        </span>
                                    </div>

                                    <div class="mt-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-slate-400 flex items-center">
                                                <i class="mdi mdi-map-marker-outline text-lg mr-1"></i>
                                                {{ $lowongan->lokasi_penugasan }}
                                                @if($lowongan->is_remote)
                                                    <span class="ml-2">(Remote)</span>
                                                @endif
                                            </span>
                                            <span class="text-slate-400 flex items-center">
                                                <i class="mdi mdi-calendar-outline text-lg mr-1"></i>
                                                Dilamar pada: {{ $lowongan->pivot->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="text-slate-400 flex items-center">
                                                <i class="mdi mdi-tag-outline text-lg mr-1"></i>
                                                {{ $lowongan->kategoriLowongan->nama_kategori }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="mt-4">
                                {{ $lamaranList->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->
</div>