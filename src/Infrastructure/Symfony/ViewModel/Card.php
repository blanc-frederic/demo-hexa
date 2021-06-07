<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class Card
{
    public int $number;
    public string $name;
    public string $set;

    public function __construct(int $number, string $name, string $set)
    {
        $this->number = $number;
        $this->name = $name;
        $this->set = $set;
    }
}
