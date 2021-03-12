<?php

declare(strict_types=1);

namespace LBN\Demo\Domain\Todo\Repository;

use LBN\Demo\Domain\Todo\Entity\Todo;

interface TodoRepository
{
    public function create(Todo $todo): ?Todo;

    public function read(int $id): ?Todo;

    public function update(int $id, Todo $todo): ?Todo;

    public function delete(int $id): bool;
}
