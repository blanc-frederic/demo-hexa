<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Deckbuilding\ChooseCards;
use OutOfBoundsException;
use OverflowException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UnderflowException;

class ChooseCardsController extends AbstractController
{
    public function __construct(
        private ChooseCards $chooseCards
    ) {
    }

    public function choose(string $deckId, Request $request): Response
    {
        $cardNumber = $request->request->getInt('number');
        $action = $request->request->getAlpha('action');

        if (($cardNumber) && (! empty($action))) {
            try {
                if ($action === 'remove') {
                    $this->chooseCards->remove($deckId, $cardNumber);
                } else {
                    $this->chooseCards->add($deckId, $cardNumber);
                }
            } catch (OverflowException | UnderflowException | OutOfBoundsException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return $this->redirectToRoute('edit_deck', ['id' => $deckId]);
    }
}
