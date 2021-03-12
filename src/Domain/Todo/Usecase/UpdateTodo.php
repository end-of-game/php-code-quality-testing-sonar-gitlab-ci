<?php

declare(strict_types=1);

namespace LBN\Demo\Domain\Todo\Usecase;

use LBN\Demo\Domain\Todo\Entity\Todo;
use LBN\Demo\Domain\Todo\Repository\TodoRepository;

final class UpdateTodo
{
    /** @var TodoRepository */
    private $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id, Todo $todo): ?Todo
    {
        if ($todo->getAction() != null) {
            return $this->repository->update($id, $todo);
        }
        return null;
    }
}
