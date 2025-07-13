<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Arr;

interface OfficerRepositoryInterface
{
    public function getAllOfficers(array $filters = [], string $sortField = 'nama_lengkap', string $sortDirection = 'asc', int $perPage = 10);
    public function findOfficer($id);
    public function createOfficer(array $data);
    public function updateOfficer($id, array $data);
    public function deleteOfficer($id);
    public function getUniquePositions();
    public function getUniqueLocations();
    public function createOfficerWithUser(array $officerData, array $userData);
    public function getAllOfficersForSupervisorSelection();
    public function getOfficerByUserId($userId);
}
