<?php

declare(strict_types=1);

namespace LBN\Tests\Domain\Todo\Usecase;

use LBN\Demo\Domain\Todo\Entity\Todo;
use LBN\Demo\Domain\Todo\Usecase\ReadTodo;
use LBN\Demo\Infra\Repository\InMemoryTodoRepository;
use PHPUnit\Framework\TestCase;


final class TestReadTodo extends TestCase
{
    /** @var TodoRepository */
    private $repository;

    /** @var ReadTodo */
    private $readTodo;

    /** @before */
    public function init(): void
    {
        $todos = [
            new Todo("Create a TODO"),
            new Todo("Read a TODO")
        ];
        $this->repository = new InMemoryTodoRepository($todos);
        $this->readTodo = new ReadTodo($this->repository);
    }

    public function testCanReadTodo(): void
    {
        $todoOut = $this->readTodo->execute(1);
        $this->assertEquals("Read a TODO", $todoOut->getAction());
    }
}
