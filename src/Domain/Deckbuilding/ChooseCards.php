<?php

declare(strict_types=1);

namespace Domain\Deckbuilding;

use Domain\Contract\CardRepository;
use Domain\Contract\DeckRepository;

class ChooseCards
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

    public function remove(string $deckId, int $cardNumber): void
    {
        $deck = $this->deckRepository->get($deckId);
        $card = $this->cardRepository->get($cardNumber);

        $deck->remove($card);

        $this->deckRepository->save($deck);
    }
}
