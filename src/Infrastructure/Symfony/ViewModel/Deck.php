<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class Deck
{
    public string $id;
    public string $name;
    public int $cardsCount;
    public bool $isStandard;

    public function __construct(string $id, string $name, int $cardsCount, bool $isStandard)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cardsCount = $cardsCount;
        $this->isStandard = $isStandard;
    }
}
