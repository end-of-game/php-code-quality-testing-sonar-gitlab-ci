<?php

declare(strict_types=1);

namespace LBN\Tests\Domain\Todo\Usecase;

use LBN\Demo\Domain\Todo\Entity\Todo;
use LBN\Demo\Domain\Todo\Usecase\DeleteTodo;
use LBN\Demo\Domain\Todo\Usecase\ReadTodo;
use LBN\Demo\Infra\Repository\InMemoryTodoRepository;
use PHPUnit\Framework\TestCase;

final class DeleteTodoTest extends TestCase
{
    /** @var TodoRepository */
    private $repository;

    /** @var DeleteTodo */
    private $deleteTodo;

    /** @before */
    public function init(): void
    {
        $todos = [
            new Todo("Create a TODO"),
            new Todo("Delete this TODO"),
            new Todo("Read a TODO"),
        ];
        $this->repository = new InMemoryTodoRepository($todos);
        $this->deleteTodo = new DeleteTodo($this->repository);
    }

    public function testCanDeleteTodo(): void
    {
        $todoOut = $this->repository->read(1);
        $this->assertEquals("Delete this TODO", $todoOut->getAction());

        $this->assertTrue($this->deleteTodo->execute(1));

        $todoOut = $this->repository->read(1);
        $this->assertNull($todoOut);
    }
}
