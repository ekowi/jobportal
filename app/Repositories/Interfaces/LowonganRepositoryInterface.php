<?php

namespace App\Repositories\Interfaces;

interface LowonganRepositoryInterface
{
    public function findLowongan($id);
    public function createLowongan(array $data);
    public function updateLowongan($id, array $data);
    public function deleteLowongan($id);
    public function getActiveLowongan(int $perPage = 10);
    public function getLowonganByKategori($kategoriId, int $perPage = 10);
    public function filterPaginate($perPage, $status, $kategori, $namaPosisi, $tanggalMulai, $tanggalAkhir);
}
