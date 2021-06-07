<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class DeckComponent
{
    public int $count;
    public int $number;
    public string $name;

    public function __construct(int $count, int $number, string $name)
    {
        $this->count = $count;
        $this->number = $number;
        $this->name = $name;
    }
}
