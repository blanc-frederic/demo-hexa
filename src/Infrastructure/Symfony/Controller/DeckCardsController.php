<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Deck\DeckCard;
use OutOfBoundsException;
use OverflowException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeckCardsController extends AbstractController
{
    private DeckCard $deckCards;

    public function __construct(DeckCard $deckCards)
    {
        $this->deckCards = $deckCards;
    }

    public function add(string $deckId, Request $request): Response
    {
        $cardNumber = $request->request->getInt('number');

        if ($cardNumber) {
            try {
                $this->deckCards->add($deckId, $cardNumber);
            } catch (OverflowException $exception) {
                $this->addFlash('error', $exception->getMessage());
            } catch (OutOfBoundsException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return $this->redirectToRoute('edit_deck', ['id' => $deckId]);
    }

    public function remove(string $deckId, Request $request): Response
    {
        $cardNumber = $request->request->getInt('number');

        if ($cardNumber) {
            try {
                $this->deckCards->remove($deckId, $cardNumber);
            } catch (OutOfBoundsException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return $this->redirectToRoute('edit_deck', ['id' => $deckId]);
    }
}
