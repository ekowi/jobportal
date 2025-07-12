<?php

namespace App\Repositories;

use App\Models\Lowongan;
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
}
