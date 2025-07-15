<?php

namespace App\Repositories;

use App\Models\Lowongan;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\LowonganRepositoryInterface;

class LowonganRepository implements LowonganRepositoryInterface
{
    protected $model;

    public function __construct(Lowongan $model)
    {
        $this->model = $model;
    }

    public function findLowongan($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createLowongan(array $data)
    {
        return $this->model->create($data);
    }

    public function updateLowongan($id, array $data)
    {
        $lowongan = $this->findLowongan($id);
        $lowongan->update($data);
        return $lowongan;
    }

    public function deleteLowongan($id)
    {
        $lowongan = $this->findLowongan($id);
        $lowongan->delete();
        return $lowongan;
    }

    public function getActiveLowongan(int $perPage = 10)
    {
        return $this->model->where('is_active', true)->paginate($perPage);
    }

    public function getLowonganByKategori($kategoriId, int $perPage = 10)
    {
        return $this->model->where('kategori_id', $kategoriId)->paginate($perPage);
    }

    public function filterPaginate(
        $perPage,
        $status = '',
        $kategori = '',
        $namaPosisi = '',
        $tanggalMulai = '',
        $tanggalAkhir = ''
    ) {
        $query = $this->model->newQuery();
        $query->paginate(10);

        if ($status) {
            $query->where('status', $status);
        }
        if ($kategori) {
            $query->where('kategori_lowongan_id', $kategori);
        }
        if ($namaPosisi) {
            $query->where('nama_posisi', 'like', '%' . $namaPosisi . '%');
        }
        if ($tanggalMulai) {
            $query->whereDate('tanggal_posting', '>=', $tanggalMulai);
        }
        if ($tanggalAkhir) {
            $query->whereDate('tanggal_berakhir', '<=', $tanggalAkhir);
        }

        return $query->paginate($perPage);
    }

    public function getAllWithFilters($search, $categoryId, $location, $isRemote, $salaryRange, $perPage = 10)
    {
        $query = $this->model->newQuery();

        // Apply filters
        if (!empty($search)) {
            $query->where('nama_posisi', 'like', '%' . $search . '%');
        }

        if (!empty($categoryId)) {
            $query->where('kategori_lowongan_id', $categoryId);
        }

        if (!empty($location)) {
            $query->where('lokasi_penugasan', $location);
        }

        if ($isRemote !== '') {
            $query->where('is_remote', $isRemote);
        }

        if (!empty($salaryRange)) {
            // Assuming salaryRange is a range like "1000-5000"
            $range = explode('-', $salaryRange);
            if (count($range) == 2) {
                $query->whereBetween('salary_range', [$range[0], $range[1]]);
            }
        }

        return $query->with('kategoriLowongan')->paginate($perPage);
    }

    public function getDistinctLocations()
    {
        // Gunakan distinct() pada query builder, lalu pluck() untuk mengambil nilai
        return $this->model->select('lokasi_penugasan')->distinct()->pluck('lokasi_penugasan');
    }

    public function getSalaryRanges()
    {
        // Gunakan unique() untuk Collection jika masih ada duplikat setelah pluck
        return $this->model->select('range_gaji')->distinct()->pluck('range_gaji')->unique();
    }

}
