<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Command;

use Domain\Deckbuilding\ListDecks;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeckListCommand extends Command
{
    public function __construct(
        private ListDecks $lister
    ) {
        parent::__construct('app:deck:list');
    }

    protected function configure(): void
    {
        $this->setDescription('Show all decks');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $decks = array_map(
            fn ($deck) => [
                $deck->getId(),
                $deck->getName(),
                $deck->getCardsCount(),
                $deck->isStandard() ? 'Yes' : 'No',
            ],
            $this->lister->list()
        );

        (new Table($output))
            ->setHeaderTitle('Decks')
            ->setHeaders(['Id', 'Name', 'Cards', 'Standard'])
            ->setRows($decks)
            ->render()
        ;

        return Command::SUCCESS;
    }
}
