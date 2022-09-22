<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Catalog\ListCards;
use Infrastructure\Symfony\ViewModel\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CardsController extends AbstractController
{
    public function __construct(
        private readonly ListCards $lister
    ) {
    }

    public function index(): Response
    {
        $cards = array_map(
            fn ($card) => new Card(
                $card->getNumber(),
                $card->getName(),
                $card->getSetName()
            ),
            $this->lister->list()
        );

        return $this->render('catalog/cards.html.twig', ['cards' => $cards]);
    }
}
