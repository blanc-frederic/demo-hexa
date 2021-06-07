<?php

declare(strict_types=1);

namespace Infrastructure\File\Repository;

use Domain\Contract\CardRepository;
use Domain\Contract\DeckFinder;
use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;
use OutOfBoundsException;

use function Safe\file_get_contents;
use function Safe\file_put_contents;
use function Safe\json_decode;
use function Safe\json_encode;
use function Safe\mkdir;

class FileDeckRepository implements DeckRepository, DeckFinder
{
    private string $path;
    private CardRepository $cardRepository;

    /** @var Deck[] */
    private array $decks;

    public function __construct(string $path, CardRepository $cardRepository)
    {
        $this->path = $path;
        $this->cardRepository = $cardRepository;
        $this->decks = [];
    }

    public function get(string $id): Deck
    {
        if (isset($this->decks[$id])) {
            return $this->decks[$id];
        }

        $filename = $this->path . '/decks/' . $id . '.json';
        if (! is_file($filename)) {
            throw new OutOfBoundsException('No deck found for this id : ' . $id);
        }

        $rawDeck = json_decode(file_get_contents($filename), true);
        $deck = new Deck($rawDeck['id'], $rawDeck['name']);
        foreach ($rawDeck['cards'] as $cardNumber) {
            $deck->add($this->cardRepository->get($cardNumber));
        }

        return $deck;
    }

    public function save(Deck $deck): void
    {
        $this->decks[$deck->getId()] = $deck;

        $decksDir = $this->path . '/decks';
        if (! is_dir($decksDir)) {
            mkdir($decksDir, 0755, true);
        }

        file_put_contents(
            $decksDir . '/' . $deck->getId() . '.json',
            json_encode([
                'id' => $deck->getId(),
                'name' => $deck->getName(),
                'cards' => array_map(
                    fn ($card) => $card->getNumber,
                    $deck->getCards()
                ),
            ])
        );
    }

    /** @return Deck[] */
    public function findAll(): array
    {
        return $this->decks;
    }
}
