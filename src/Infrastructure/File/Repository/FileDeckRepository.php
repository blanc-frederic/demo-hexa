<?php

declare(strict_types=1);

namespace Infrastructure\File\Repository;

use Domain\Contract\CardRepository;
use Domain\Contract\DeckFinder;
use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;
use OutOfBoundsException;
use UnexpectedValueException;

use function Safe\file_get_contents;
use function Safe\file_put_contents;
use function Safe\glob;
use function Safe\json_decode;
use function Safe\json_encode;
use function Safe\mkdir;

class FileDeckRepository implements DeckRepository, DeckFinder
{
    private string $path;

    /** @var Deck[] */
    private array $decks = [];

    public function __construct(
        string $dataPath,
        private CardRepository $cardRepository
    ) {
        $this->path = $dataPath . '/decks';
    }

    public function get(string $id): Deck
    {
        if (isset($this->decks[$id])) {
            return $this->decks[$id];
        }

        $filename = $this->path . '/' . $id . '.json';
        if (! is_file($filename)) {
            throw new OutOfBoundsException('No deck found for this id : ' . $id);
        }

        $rawDeck = json_decode(file_get_contents($filename), true);
        if (! is_array($rawDeck)) {
            throw new UnexpectedValueException('Deck store corrupted');
        }
        $this->decks[$id] = new Deck($rawDeck['id'], $rawDeck['name']);
        foreach ($rawDeck['cards'] as $cardNumber) {
            $this->decks[$id]->add($this->cardRepository->get($cardNumber));
        }

        return $this->decks[$id];
    }

    public function save(Deck $deck): void
    {
        $this->decks[$deck->getId()] = $deck;

        if (! is_dir($this->path)) {
            mkdir($this->path, 0755, true);
        }

        file_put_contents(
            $this->path . '/' . $deck->getId() . '.json',
            json_encode([
                'id' => $deck->getId(),
                'name' => $deck->getName(),
                'cards' => array_map(
                    fn ($card) => $card->getNumber(),
                    $deck->getCards()
                ),
            ])
        );
    }

    /** @return Deck[] */
    public function findAll(): array
    {
        foreach (glob($this->path . '/*.json') as $filename) {
            $id = basename($filename, '.json');
            if (! isset($this->decks[$id])) {
                $this->get($id);
            }
        }

        return $this->decks;
    }
}
