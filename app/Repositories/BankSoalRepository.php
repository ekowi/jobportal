<?php

namespace App\Repositories;

use App\Models\Soal;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\BankSoalRepositoryInterface;

class BankSoalRepository implements BankSoalRepositoryInterface
{
    protected $model;

    public function __construct(Soal $model)
    {
        $this->model = $model;
    }

    public function findSoal($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createSoal(array $data)
    {
        return $this->model->create($data);
    }

    public function updateSoal($id, array $data)
    {
        $soal = $this->findSoal($id);
        $soal->update($data);
        return $soal;
    }

    public function deleteSoal($id)
    {
        $soal = $this->findSoal($id);
        $soal->delete();
        return $soal;
    }

    public function getActiveSoal(int $perPage = 10)
    {
        return $this->model->where('status', true)->paginate($perPage);
    }

    public function getSoalByKategori($kategoriId, int $perPage = 10)
    {
        return $this->model->where('id_kategori_soal', $kategoriId)->paginate($perPage);
    }

    public function filterPaginate(
        $perPage,
        $status = '',
        $kategori = '',
        $soal = ''
    ) {
        $query = $this->model->newQuery();

        if ($status !== '') {
            $query->where('status', $status);
        }
        if ($kategori) {
            $query->where('id_kategori_soal', $kategori);
        }
        if ($soal) {
            $query->where('soal', 'like', '%' . $soal . '%');
        }

        return $query->paginate($perPage);
    }
}