<?php

namespace App\Repositories\Interfaces;

interface KandidatRepositoryInterface
{
    public function findByUserId($userId);
    public function updateOrCreate(array $attributes, array $values);
}
