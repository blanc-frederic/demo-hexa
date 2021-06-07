<?php

declare(strict_types=1);

namespace Infrastructure\Memory;

use Domain\Contract\IdentifierGenerator;

class MemoryIdGenerator implements IdentifierGenerator
{
    public function generate(): string
    {
        return uniqid();
    }
}
