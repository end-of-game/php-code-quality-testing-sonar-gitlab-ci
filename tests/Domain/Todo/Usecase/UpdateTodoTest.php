<?php

declare(strict_types=1);

namespace LBN\Tests\Domain\Todo\Usecase;

use LBN\Demo\Domain\Todo\Entity\Todo;
use LBN\Demo\Domain\Todo\Usecase\ReadTodo;
use LBN\Demo\Domain\Todo\Usecase\UpdateTodo;
use LBN\Demo\Infra\Repository\InMemoryTodoRepository;
use PHPUnit\Framework\TestCase;

final class UpdateTodoTest extends TestCase
{
    /** @var TodoRepository */
    private $repository;

    /** @var UpdateTodo */
    private $updateTodo;

    /** @before */
    public function init(): void
    {
        $todos = [
            new Todo("Create a TODO"),
            new Todo("Update this TODO"),
            new Todo("Read a TODO"),
        ];
        $this->repository = new InMemoryTodoRepository($todos);
        $this->updateTodo = new UpdateTodo($this->repository);
    }

    public function testCanUpdateTodo(): void
    {
        $todoOut = $this->repository->read(1);
        $this->assertEquals("Update this TODO", $todoOut->getAction());

        $todoOut->setAction("Updated");
        $this->updateTodo->execute(1, $todoOut);

        $todoUpdated = $this->repository->read(1);
        $this->assertEquals("Updated", $todoUpdated->getAction());
    }
}
