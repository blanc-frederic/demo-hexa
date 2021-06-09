<?php

declare(strict_types=1);

namespace Infrastructure\File\Fixtures;

use Infrastructure\Contract\FixturesLoaderInterface;

use function Safe\file_put_contents;
use function Safe\json_encode;
use function Safe\mkdir;

class SetsFixtures implements FixturesLoaderInterface
{
    private string $path;

    public function __construct(string $dataPath)
    {
        $this->path = $dataPath;
    }

    public function getName(): string
    {
        return 'Sets fixtures';
    }

    public function isNeeded(): bool
    {
        return ! is_file($this->path . '/sets.json');
    }

    public function load(): void
    {
        if (! $this->isNeeded()) {
            return;
        }

        if (! is_dir($this->path)) {
            mkdir($this->path, 0755, true);
        }

        file_put_contents($this->path . '/sets.json', json_encode([
            ['code' => 'CORE', 'name' => 'Core set', 'standard' => true],
            ['code' => 'EXPERT1', 'name' => 'Classic set', 'standard' => true],
            ['code' => 'NAXX', 'name' => 'Curse of Naxxramas', 'standard' => false],
            ['code' => 'GVG', 'name' => 'Goblins vs Gnomes', 'standard' => false],
            ['code' => 'BRM', 'name' => 'Blacrock Mountain', 'standard' => false],
            ['code' => 'TGT', 'name' => 'The Grand Tournament', 'standard' => false],
            ['code' => 'LOE', 'name' => 'League of Explorers', 'standard' => false],
            ['code' => 'OG', 'name' => 'Whispers of the Old Gods', 'standard' => false],
            ['code' => 'KARA', 'name' => 'One Night in Karazhan', 'standard' => false],
            ['code' => 'GANGS', 'name' => 'Mean Streets of Gadgetzan', 'standard' => false],
        ]));
    }
}
