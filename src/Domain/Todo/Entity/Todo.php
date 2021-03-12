<?php

declare(strict_types=1);

namespace LBN\Demo\Domain\Todo\Entity;

final class Todo
{
    /** @var string */
    private $action;

    public function __construct(string $action)
    {
        $this->setAction($action);
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction(string $action)
    {
        $this->action = $action;
    }
}
