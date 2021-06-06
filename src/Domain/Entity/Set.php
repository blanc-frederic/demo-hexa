<?php

declare(strict_types=1);

namespace Domain\Entity;

class Set
{
    private string $code;
    private string $name;
    private bool $isStandard;
    
    public function __construct(string $code, string $name, bool $isStandard = true)
    {
        $this->code = $code;
        $this->name = $name;
        $this->isStandard = $isStandard;
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
