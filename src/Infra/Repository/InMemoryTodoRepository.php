<?php

declare(strict_types=1);

namespace LBN\Demo\Infra\Repository;

use LBN\Demo\Domain\Todo\Entity\Todo;
use LBN\Demo\Domain\Todo\Repository\TodoRepository;

final class InMemoryTodoRepository implements TodoRepository
{
    /** @var array */
    private $todos;

    public function __construct(array $todos = [])
    {
        $this->todos = $todos;
    }

    public function create(Todo $todo): ?Todo
    {
        array_push($this->todos, $todo);
        return $todo;
    }

    public function read(int $id): ?Todo
    {
        if (array_key_exists($id, $this->todos)) {
            return $this->todos[$id];
        } else {
            return null;
        }
    }

    public function update(int $id, Todo $todo): ?Todo
    {
        if (array_key_exists($id, $this->todos)) {
            $this->todos[$id] = $todo;
        } else {
            return null;
        }
        return $todo;
    }

    public function delete(int $id): bool
    {
        if (array_key_exists($id, $this->todos)) {
            $this->todos[$id] = null;
        } else {
            return false;
        }
        return true;
    }
}
