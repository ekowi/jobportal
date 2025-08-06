<?php

namespace App\Repositories;

use App\Models\KategoriSoal;
use App\Repositories\interfaces\KategoriSoalRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentKategoriSoalRepository implements KategoriSoalRepositoryInterface
{
    protected $model;

    public function __construct(KategoriSoal $model)
    {
        $this->model = $model;
    }

    public function getPaginated(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return $this->model
            ->where('nama_kategori', 'like', '%' . $search . '%')
            ->latest()
            ->paginate($perPage);
    }

    public function find(int $id): ?KategoriSoal
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): KategoriSoal
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $kategori = $this->find($id);
        return $kategori->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }
}