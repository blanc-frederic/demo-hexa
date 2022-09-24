<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Contract\DeckFinder;
use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;
use OutOfBoundsException;

class DoctrineDeckRepository implements DeckRepository, DeckFinder
{
    /** @var ServiceEntityRepository<Deck> */
    private readonly ServiceEntityRepository $repository;

    public function __construct(
        private readonly ManagerRegistry $registry
    ) {
        $this->repository = new ServiceEntityRepository($registry, Deck::class);
    }

    public function get(string $id): Deck
    {
        $deck = $this->repository->find($id);
        if ($deck === null) {
            throw new OutOfBoundsException('No Deck with id "' . $id . '"');
        }
        return $deck;
    }

    public function save(Deck $deck): void
    {
        $entityManager = $this->registry->getManager();

        $entityManager->persist($deck);
        $entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
