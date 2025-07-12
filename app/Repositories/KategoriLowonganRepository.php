<?php
namespace App\Repositories;

use App\Models\KategoriLowongan;
use App\Repositories\Interfaces\KategoriLowonganRepositoryInterface;

class KategoriLowonganRepository implements KategoriLowonganRepositoryInterface
{

    protected $model;

    public function __construct(KategoriLowongan $model)
    {
        $this->model = $model;
    }
    
    public function getActive()
    {
        return $this->model->where('is_active', true)->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $kategori = $this->find($id);
        $kategori->update($data);
        return $kategori;
    }

    public function softDelete($id, $userId)
    {
        $kategori = $this->find($id);
        $kategori->update([
            'is_active' => false,
            'user_update' => $userId,
        ]);
        return $kategori;
    }
}
