<?php

namespace App\Repositories\interfaces;

use App\Models\KategoriSoal;
use Illuminate\Pagination\LengthAwarePaginator;

interface KategoriSoalRepositoryInterface
{
    /**
     * Mengambil data kategori dengan paginasi dan fitur pencarian.
     *
     * @param string $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginated(string $search = '', int $perPage = 10): LengthAwarePaginator;

    /**
     * Mencari kategori berdasarkan ID.
     *
     * @param int $id
     * @return KategoriSoal|null
     */
    public function find(int $id): ?KategoriSoal;

    /**
     * Membuat data kategori baru.
     *
     * @param array $data
     * @return KategoriSoal
     */
    public function create(array $data): KategoriSoal;

    /**
     * Memperbarui data kategori berdasarkan ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Menghapus data kategori berdasarkan ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}