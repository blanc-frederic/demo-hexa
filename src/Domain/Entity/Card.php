<?php

declare(strict_types=1);

namespace Domain\Entity;

class Card
{
    public function __construct(
        private readonly int $number,
        private readonly string $name,
        private readonly Set $set
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

    public function getSetCode(): string
    {
        return $this->set->getCode();
    }

    public function isStandard(): bool
    {
        return $this->set->isStandard();
    }
}
