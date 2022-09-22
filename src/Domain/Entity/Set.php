<?php

declare(strict_types=1);

namespace Domain\Entity;

class Set
{
    public function __construct(
        private string $code,
        private string $name,
        private bool $isStandard = true
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isStandard(): bool
    {
        return $this->isStandard;
    }
}
