<?php
namespace App\Repositories\Interfaces;

interface KategoriLowonganRepositoryInterface
{
    public function getActive();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function softDelete($id, $userId);
}
