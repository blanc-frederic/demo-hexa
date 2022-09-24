<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Contract\SetRepository;
use Domain\Entity\Set;
use OutOfBoundsException;

class DoctrineSetRepository implements SetRepository
{
    /** @var ServiceEntityRepository<Set> */
    private readonly ServiceEntityRepository $repository;

    public function __construct(
        private readonly ManagerRegistry $registry
    ) {
        $this->repository = new ServiceEntityRepository($registry, Set::class);
    }

    public function get(string $code): Set
    {
        $set = $this->repository->find($code);
        if ($set === null) {
            throw new OutOfBoundsException('No Set with code "' . $code . '"');
        }
        return $set;
    }

    public function save(Set $set): void
    {
        $entityManager = $this->registry->getManager();

        $entityManager->persist($set);
        $entityManager->flush();
    }
}
