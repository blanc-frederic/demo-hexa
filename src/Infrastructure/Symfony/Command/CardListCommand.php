<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Command;

use Domain\Catalog\ListCards;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CardListCommand extends Command
{
    public function __construct(
        private ListCards $lister
    ) {
        parent::__construct('app:card:list');
    }

    protected function configure(): void
    {
        $this->setDescription('Show all cards');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $cards = array_map(
            fn ($card) => [
                $card->getNumber(),
                $card->getName(),
                $card->getSetName(),
                $card->isStandard() ? 'Yes' : 'No',
            ],
            $this->lister->list()
        );

        (new Table($output))
            ->setHeaderTitle('Cards')
            ->setHeaders(['#', 'Name', 'Set', 'Standard'])
            ->setRows($cards)
            ->render()
        ;

        return Command::SUCCESS;
    }
}
