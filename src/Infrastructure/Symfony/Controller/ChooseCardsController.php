<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Deckbuilding\ChooseCards;
use OutOfBoundsException;
use OverflowException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChooseCardsController extends AbstractController
{
    private ChooseCards $chooseCards;

    public function __construct(ChooseCards $chooseCards)
    {
        $this->chooseCards = $chooseCards;
    }

    public function add(string $deckId, Request $request): Response
    {
        $cardNumber = $request->request->getInt('number');

        if ($cardNumber) {
            try {
                $this->chooseCards->add($deckId, $cardNumber);
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
                $this->chooseCards->remove($deckId, $cardNumber);
            } catch (OutOfBoundsException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return $this->redirectToRoute('edit_deck', ['id' => $deckId]);
    }
}
