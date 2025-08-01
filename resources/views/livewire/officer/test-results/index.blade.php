<div>
    <!-- Hero Start -->
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('images/hero/bg.jpg') }}');">
        <div class="bg-overlay bg-gradient-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h5 class="heading fw-semibold mb-0 sub-heading text-white title-dark">Hasil Test CBT</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card border-0 rounded shadow">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" wire:model.debounce.300ms="search" 
                                           class="form-control" 
                                           placeholder="Cari berdasarkan nama/email...">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center justify-content-end">
                                    <label for="sortField" class="form-label me-2 mb-0 text-muted">Urutkan:</label>
                                        <select wire:model.live="sortField" id="sortField" class="form-select w-auto me-2">
                                            <option value="created_at">Tanggal Tes</option>
                                            <option value="score">Skor</option>
                                            {{-- Opsi untuk mengurutkan berdasarkan nama memerlukan join, jadi kita gunakan kolom yang ada di tabel utama --}}
                                        </select>
                                        <select wire:model.live="sortDirection" class="form-select w-auto">
                                            <option value="desc">Terbaru / Tertinggi</option>
                                            <option value="asc">Terlama / Terendah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3 text-center" wire:click="sortBy('user_id')" style="cursor: pointer;">
                                                Nama Kandidat
                                                @if($sortField === 'user_id')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </th>
                                            <th class="border-bottom p-3 text-center" wire:click="sortBy('score')" style="cursor: pointer;">
                                                Nilai
                                                @if($sortField === 'score')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </th>
                                            <th class="border-bottom p-3 text-center">Jawaban Benar</th>
                                            <th class="border-bottom p-3 text-center">Total Soal</th>
                                            <th class="border-bottom p-3 text-center" wire:click="sortBy('started_at')" style="cursor: pointer;">
                                                Waktu Mulai
                                                @if($sortField === 'started_at')
                                                    <i class="mdi mdi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </th>
                                            <th class="border-bottom p-3 text-center">Durasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($results as $result)
                                        <tr>
                                            <td class="p-3 text-center">{{ $result->user->name }}</td>
                                            <td class="p-3 text-center">
                                                <span class="badge bg-{{ $result->score >= 70 ? 'success' : 'danger' }}">
                                                    {{ number_format($result->score, 2) }}%
                                                </span>
                                            </td>
                                            <td class="p-3 text-center">{{ $result->correct_answers }}</td>
                                            <td class="p-3 text-center">{{ $result->total_questions }}</td>
                                            <td class="p-3 text-center">{{ $result->started_at->format('d M Y H:i') }}</td>
                                            <td class="p-3 text-center">
                                                @if($result->completed_at)
                                                    {{ number_format($result->started_at->diffInSeconds($result->completed_at) / 60, 1) }} menit
                                                @else
                                                    Belum selesai
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-3">
                                                Belum ada hasil test
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $results->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>