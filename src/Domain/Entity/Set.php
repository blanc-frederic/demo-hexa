<?php

declare(strict_types=1);

namespace Domain\Entity;

class Set
{
    public function __construct(
        private readonly string $code,
        private readonly string $name,
        private readonly bool $isStandard = true
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
