<?php

declare(strict_types=1);

namespace Infrastructure\Contract;

interface FixturesLoaderInterface
{
    public function getName(): string;
    public function isNeeded(): bool;
    public function load(): void;
}
