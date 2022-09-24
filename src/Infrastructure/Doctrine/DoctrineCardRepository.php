<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Contract\CardFinder;
use Domain\Contract\CardRepository;
use Domain\Entity\Card;
use OutOfBoundsException;

class DoctrineCardRepository implements CardRepository, CardFinder
{
    /** @var ServiceEntityRepository<Card> */
    private readonly ServiceEntityRepository $repository;

    public function __construct(
        private readonly ManagerRegistry $registry
    ) {
        $this->repository = new ServiceEntityRepository($registry, Card::class);
    }

    public function get(int $number): Card
    {
        $card = $this->repository->find($number);
        if ($card === null) {
            throw new OutOfBoundsException('No Card with number ' . $number);
        }
        return $card;
    }

    public function save(Card $card): void
    {
        $entityManager = $this->registry->getManager();

        $entityManager->persist($card);
        $entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findStandard(): array
    {
        return array_filter(
            $this->repository->findAll(),
            fn(Card $card) => $card->isStandard()
        );
    }
}
