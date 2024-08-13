<?php

namespace Rodovale\Database\Interfaces;

use Exception;
use Rodovale\Database\DTO\ViagemDTO;
use Rodovale\Exceptions\PersistenceException;

interface BaseDAO
{
    public function create(ViagemDTO $viagem): void;

    public function fetchAll(): array | PersistenceException;

    public function fetchOne(int $id): ViagemDTO | PersistenceException | null;

    public function fetchLast(): ?ViagemDTO;

    public function update(ViagemDTO $viagem): void;

    public function delete(int $id): void;
}
