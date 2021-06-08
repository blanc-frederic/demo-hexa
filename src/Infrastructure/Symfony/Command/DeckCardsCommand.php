<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Command;

use Domain\Contract\DeckRepository;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeckCardsCommand extends Command
{
    private DeckRepository $repository;

    public function __construct(DeckRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct('app:deck:cards');
    }

    protected function configure(): void
    {
        $this->setDescription('Show all cards in a deck');
        $this->addArgument('id', InputArgument::REQUIRED, 'Deck id');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $input->getArgument('id');
        if (! is_string($id)) {
            throw new InvalidArgumentException('Deck id must be a string');
        }

        $deck = $this->repository->get($id);

        $components = array_map(
            fn ($component) => [
                $component->getCardNumber(),
                $component->getCardName(),
                $component->getCount(),
            ],
            $deck->getComponents()
        );

        (new Table($output))
            ->setHeaderTitle($deck->getName())
            ->setHeaders(['#', 'Name', 'Count'])
            ->setRows($components)
            ->render()
        ;

        return Command::SUCCESS;
    }
}
