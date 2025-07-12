<?php
namespace App\Repositories;

use App\Models\KategoriLowongan;
use App\Repositories\Interfaces\KategoriLowonganRepositoryInterface;

class KategoriLowonganRepository implements KategoriLowonganRepositoryInterface
{
    public function getActive()
    {
        return KategoriLowongan::where('is_active', true)->get();
    }

    public function find($id)
    {
        return KategoriLowongan::findOrFail($id);
    }

    public function create(array $data)
    {
        return KategoriLowongan::create($data);
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
