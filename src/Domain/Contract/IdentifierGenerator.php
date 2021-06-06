<?php

declare(strict_types=1);

namespace Domain\Contract;

interface IdentifierGenerator
{
    public function generate(): string;
}
