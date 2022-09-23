<?php

declare(strict_types=1);

namespace Infrastructure\File\Repository;

use Domain\Contract\SetRepository;
use Domain\Entity\Set;
use OutOfBoundsException;
use UnexpectedValueException;

use function Safe\file_get_contents;
use function Safe\file_put_contents;
use function Safe\json_decode;
use function Safe\json_encode;
use function Safe\mkdir;

class FileSetRepository implements SetRepository
{
    private readonly string $filename;
    /** @var Set[] */
    private array $sets = [];

    public function __construct(string $dataPath)
    {
        $this->filename = $dataPath . '/sets.json';
    }

    public function get(string $code): Set
    {
        $this->loadSets();

        if (! isset($this->sets[$code])) {
            throw new OutOfBoundsException('No set found for this code : ' . $code);
        }

        return $this->sets[$code];
    }

    public function save(Set $set): void
    {
        $this->loadSets();
        $this->sets[$set->getCode()] = $set;
        $this->saveSets();
    }

    private function loadSets(): void
    {
        if ((empty($this->sets)) && (is_file($this->filename))) {
            $raw = json_decode(file_get_contents($this->filename), true);
            if (! is_array($raw)) {
                throw new UnexpectedValueException('Set store corrupted');
            }
            foreach ($raw as $rawSet) {
                $this->sets[$rawSet['code']] = new Set(
                    $rawSet['code'],
                    $rawSet['name'],
                    $rawSet['standard']
                );
            }
        }
    }

    private function saveSets(): void
    {
        if (! is_dir(dirname($this->filename))) {
            mkdir(dirname($this->filename), 0755, true);
        }

        file_put_contents($this->filename, json_encode(array_map(
            fn(Set $set) => [
                'code' => $set->getCode(),
                'name' => $set->getName(),
                'standard' => $set->isStandard(),
            ],
            array_values($this->sets)
        )));
    }
}
