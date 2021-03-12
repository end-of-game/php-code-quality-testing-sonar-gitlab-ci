<?php

declare(strict_types=1);

namespace LBN\Demo\Domain\Todo\Usecase;

use LBN\Demo\Domain\Todo\Entity\Todo;
use LBN\Demo\Domain\Todo\Repository\TodoRepository;

final class ReadTodo
{
    /** @var TodoRepository */
    private $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): ?Todo
    {
        return $this->repository->read($id);
    }
}
