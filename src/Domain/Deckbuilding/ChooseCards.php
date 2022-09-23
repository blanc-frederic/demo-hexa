<?php

declare(strict_types=1);

namespace Domain\Deckbuilding;

use Domain\Contract\CardRepository;
use Domain\Contract\DeckRepository;
use OverflowException;

class ChooseCards
{
    final public const MAX_CARDS_PER_DECK = 30;

    public function __construct(
        private readonly DeckRepository $deckRepository,
        private readonly CardRepository $cardRepository
    ) {
    }

    public function add(string $deckId, int $cardNumber): void
    {
        $deck = $this->deckRepository->get($deckId);
        if ($deck->getCardsCount() === self::MAX_CARDS_PER_DECK) {
            throw new OverflowException('Deck can only contain ' . self::MAX_CARDS_PER_DECK . ' cards');
        }

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
