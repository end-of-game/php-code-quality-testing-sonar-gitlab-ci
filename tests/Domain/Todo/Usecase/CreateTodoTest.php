<?php

declare(strict_types=1);

namespace LBN\Tests\Domain\Todo\Usecase;

use LBN\Demo\Domain\Todo\Entity\Todo;
use LBN\Demo\Domain\Todo\Usecase\CreateTodo;
use LBN\Demo\Infra\Repository\InMemoryTodoRepository;
use PHPUnit\Framework\TestCase;

final class CreateTodoTest extends TestCase
{
    /** @var TodoRepository */
    private $repository;

    /** @var CreateTodo */
    private $createTodo;

    /** @before */
    public function init(): void
    {
        $this->repository = new InMemoryTodoRepository();
        $this->createTodo = new CreateTodo($this->repository);
    }
    
    public function testCanAddTodo(): void
    {
        $todoIn = new Todo("Create a TODO");
        $todoOut = $this->createTodo->execute($todoIn);

        $this->assertEquals("Create a TODO", $todoOut->getAction());
    }
}
