<?php

declare(strict_types=1);

namespace Domain\Deck;

use Domain\Contract\CardRepository;
use Domain\Contract\DeckRepository;

class AddCard
{
    private DeckRepository $deckRepository;
    private CardRepository $cardRepository;

    public function __construct(DeckRepository $deckRepository, CardRepository $cardRepository)
    {
        $this->deckRepository = $deckRepository;
        $this->cardRepository = $cardRepository;
    }

    public function add(string $deckId, int $cardNumber): void
    {
        $deck = $this->deckRepository->get($deckId);
        $card = $this->cardRepository->get($cardNumber);

        $deck->add($card);

        $this->deckRepository->save($deck);
    }
}
