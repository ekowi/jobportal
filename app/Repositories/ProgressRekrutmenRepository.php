<?php

namespace App\Repositories;

use App\Models\ProgressRekrutmen;
use App\Models\Lamarlowongan;
use App\Models\Lowongan;
use App\Repositories\Interfaces\ProgressRekrutmenRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProgressRekrutmenRepository implements ProgressRekrutmenRepositoryInterface
{
    /**
     * @var ProgressRekrutmen
     */
    protected $progressRekrutmen;

    /**
     * @var Lamarlowongan
     */
    protected $lamarLowongan;

    /**
     * @var Lowongan
     */
    protected $lowongan;

    /**
     * ProgressRekrutmenRepository constructor.
     *
     * @param ProgressRekrutmen $progressRekrutmen
     * @param Lamarlowongan $lamarLowongan
     * @param Lowongan $lowongan
     */
    public function __construct(
        ProgressRekrutmen $progressRekrutmen,
        Lamarlowongan $lamarLowongan,
        Lowongan $lowongan
    ) {
        $this->progressRekrutmen = $progressRekrutmen;
        $this->lamarLowongan = $lamarLowongan;
        $this->lowongan = $lowongan;
    }

    /**
     * Get progress by ID with related data
     *
     * @param int $id
     * @return ProgressRekrutmen|null
     */
    public function getDetailProgressById(int $id): ?ProgressRekrutmen
    {
        return $this->progressRekrutmen->query()
            ->with([
                'lamarlowongan.kandidat',
                'lamarlowongan.lowongan',
                'officer.user',
                'interview'
            ])
            ->findOrFail($id);
    }

    /**
     * Get unique lamar lowongans with pagination and filters
     *
     * @param string|null $search
     * @param string|null $filterLowongan
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUniqueLamarLowongans(?string $search, ?string $filterLowongan, int $perPage = 10): LengthAwarePaginator
    {
        return $this->lamarLowongan->query()
            ->with(['kandidat', 'lowongan'])
            ->when($search, function($query) use ($search) {
                $query->whereHas('kandidat', function($q) use ($search) {
                    $q->where('nama_depan', 'like', '%'.$search.'%')
                    ->orWhere('nama_belakang', 'like', '%'.$search.'%');
                })->orWhereHas('lowongan', function($q) use ($search) {
                    $q->where('nama_posisi', 'like', '%'.$search.'%');
                });
            })
            ->when($filterLowongan, function($query) use ($filterLowongan) {
                $query->whereHas('lowongan', function($q) use ($filterLowongan) {
                    $q->where('id', $filterLowongan);
                });
            })
            ->paginate($perPage);
    }

    /**
     * Get lowongan options for dropdown
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLowonganOptions()
    {
        return $this->lowongan->query()->orderBy('nama_posisi')->get();
    }

    /**
     * Get progress history by lamar lowongan id
     *
     * @param int $lamarLowonganId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProgressByLamarLowonganId(int $lamarLowonganId)
    {
        return $this->progressRekrutmen->query()
            ->where('lamar_lowongan_id', $lamarLowonganId)
            ->orderBy('waktu_pelaksanaan')
            ->get();
    }

    /**
     * Get appropriate color for status
     *
     * @param string $status
     * @return string
     */
    public function getStatusColor(string $status): string
    {
        return match(strtolower($status)) {
            'selesai', 'diterima', 'lulus' => 'success',
            'proses', 'sedang berlangsung', 'menunggu' => 'warning',
            'gagal', 'ditolak', 'tidak lulus' => 'danger',
            default => 'secondary',
        };
    }
}
