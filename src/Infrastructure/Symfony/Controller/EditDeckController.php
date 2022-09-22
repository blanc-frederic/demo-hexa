<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Catalog\ListCards;
use Domain\Deckbuilding\ListDeckCards;
use Infrastructure\Symfony\ViewModel\Card;
use Infrastructure\Symfony\ViewModel\Deck;
use Infrastructure\Symfony\ViewModel\DeckComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EditDeckController extends AbstractController
{
    public function __construct(
        private readonly ListDeckCards $lister,
        private readonly ListCards $listCards
    ) {
    }

    public function edit(string $id): Response
    {
        $deck = $this->lister->getDeck($id);

        $viewDeck = new Deck(
            $deck->getId(),
            $deck->getName(),
            $deck->getCardsCount(),
            $deck->isStandard()
        );

        $viewComponents = array_map(fn ($component) => new DeckComponent(
            $component->getCount(),
            $component->getCardNumber(),
            $component->getCardName()
        ), $deck->getComponents());

        $viewCards = array_map(fn ($card) => new Card(
            $card->getNumber(),
            $card->getName(),
            $card->getSetName()
        ), $this->listCards->list());

        return $this->render('deckbuilding/edit.html.twig', [
            'deck' => $viewDeck,
            'components' => $viewComponents,
            'cards' => $viewCards,
        ]);
    }
}
