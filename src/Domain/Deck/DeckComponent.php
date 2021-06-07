<?php

declare(strict_types=1);

namespace Domain\Deck;

use Domain\Entity\Card;

class DeckComponent
{
    public int $count = 1;
    private Card $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function getCardNumber(): int
    {
        return $this->card->getNumber();
    }

    public function getCardName(): string
    {
        return $this->card->getName();
    }
}
