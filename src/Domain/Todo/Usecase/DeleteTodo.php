<?php

declare(strict_types=1);

namespace LBN\Demo\Domain\Todo\Usecase;

use LBN\Demo\Domain\Todo\Repository\TodoRepository;

final class DeleteTodo
{
    /** @var TodoRepository */
    private $repository;

    private $uselessAttribute;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
