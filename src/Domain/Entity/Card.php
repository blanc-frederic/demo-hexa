<?php

declare(strict_types=1);

namespace Domain\Entity;

class Card
{
    public function __construct(
        private int $number,
        private string $name,
        private Set $set
    ) {
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSetName(): string
    {
        return $this->set->getName();
    }

    public function isStandard(): bool
    {
        return $this->set->isStandard();
    }
}
