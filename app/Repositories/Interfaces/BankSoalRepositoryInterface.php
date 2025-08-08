<?php

namespace App\Repositories\Interfaces;

interface BankSoalRepositoryInterface
{
    public function findSoal($id);
    public function createSoal(array $data);
    public function updateSoal($id, array $data);
    public function deleteSoal($id);
    public function getActiveSoal(int $perPage = 10);
    public function getSoalByKategori($kategoriId, int $perPage = 10);
    public function filterPaginate(
        $perPage,
        $status = '',
        $kategori = '',
        $soal = ''
    );
}