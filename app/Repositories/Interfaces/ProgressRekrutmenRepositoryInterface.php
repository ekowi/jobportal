<?php

namespace App\Repositories\Interfaces;

use App\Models\ProgressRekrutmen;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProgressRekrutmenRepositoryInterface
{
    /**
     * Get progress by ID with related data
     *
     * @param int $id
     * @return ProgressRekrutmen|null
     */
    public function getDetailProgressById(int $id): ?ProgressRekrutmen;

    /**
     * Get unique lamar lowongans with pagination and filters
     *
     * @param string|null $search
     * @param string|null $filterStatus
     * @param string|null $filterLowongan
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUniqueLamarLowongans(?string $search, ?string $filterLowongan, int $perPage = 10): LengthAwarePaginator;

    /**
     * Get lowongan options for dropdown
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLowonganOptions();

    /**
     * Get progress history by lamar lowongan id
     *
     * @param int $lamarLowonganId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProgressByLamarLowonganId(int $lamarLowonganId);

    /**
     * Get appropriate color for status
     *
     * @param string $status
     * @return string
     */
    public function getStatusColor(string $status): string;
}
