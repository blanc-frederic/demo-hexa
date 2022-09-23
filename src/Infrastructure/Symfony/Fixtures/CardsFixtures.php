<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Fixtures;

use Domain\Contract\CardRepository;
use Domain\Entity\Card;
use Domain\Entity\Set;
use Infrastructure\Contract\FixturesLoaderInterface;
use OutOfBoundsException;

use function Safe\array_combine;

class CardsFixtures implements FixturesLoaderInterface
{
    public function __construct(
        private readonly CardRepository $repository,
        private readonly SetsFixtures $setFixtures
    ) {
    }

    public static function getDefaultPriority(): int
    {
        // let Sets fixtures load first
        return 2;
    }

    public function getName(): string
    {
        return 'Cards fixtures';
    }

    public function isNeeded(): bool
    {
        try {
            $this->repository->get(64);
            return false;
        } catch (OutOfBoundsException) {
            return true;
        }
    }

    public function load(): void
    {
        if (! $this->isNeeded()) {
            return;
        }

        array_map(
            fn(Card $card) => $this->repository->save($card),
            $this->getCards()
        );
    }

    /** @return Card[] */
    public function getCards(): array
    {
        $sets = array_combine(
            array_map(fn(Set $set) => $set->getCode(), $this->setFixtures->getSets()),
            $this->setFixtures->getSets()
        );

        return [
            new Card(64, 'Swipe', $sets['CORE']),
            new Card(205, 'Ironbark Protector', $sets['CORE']),
            new Card(213, 'Mark of the Wild', $sets['CORE']),
            new Card(254, 'Innervate', $sets['CORE']),
            new Card(467, 'Moonfire', $sets['CORE']),
            new Card(742, 'Savage Roar', $sets['CORE']),
            new Card(773, 'Healing Touch', $sets['CORE']),
            new Card(823, 'Starfire', $sets['CORE']),
            new Card(1050, 'Claw', $sets['CORE']),
            new Card(1124, 'Wild Growth', $sets['CORE']),

            new Card(86, 'Starfall', $sets['EXPERT1']),
            new Card(95, 'Nourish', $sets['EXPERT1']),
            new Card(151, 'Mark of Nature', $sets['EXPERT1']),
            new Card(233, 'Naturalize', $sets['EXPERT1']),
            new Card(381, 'Soul of the Forest', $sets['EXPERT1']),
            new Card(481, 'Savagery', $sets['EXPERT1']),
            new Card(493, 'Force of Nature', $sets['EXPERT1']),
            new Card(503, 'Power of the Wild', $sets['EXPERT1']),
            new Card(577, 'Bite', $sets['EXPERT1']),
            new Card(601, 'Keeper of the Grove', $sets['EXPERT1']),
            new Card(692, 'Druid of the Claw', $sets['EXPERT1']),
            new Card(836, 'Wrath', $sets['EXPERT1']),
            new Card(920, 'Ancient of Lore', $sets['EXPERT1']),
            new Card(1035, 'Ancient of War', $sets['EXPERT1']),

            new Card(1802, 'Poison Seeds', $sets['NAXX']),

            new Card(1995, 'Recycle', $sets['GVG']),
            new Card(2001, 'Tree of Life', $sets['GVG']),
            new Card(2002, 'Mech-Bear-Cat', $sets['GVG']),
            new Card(2009, 'Dark Wispers', $sets['GVG']),
            new Card(2048, 'Druid of the Fang', $sets['GVG']),
            new Card(2096, 'Anodized Robo Cub', $sets['GVG']),
            new Card(2225, 'Grove Tender', $sets['GVG']),

            new Card(2292, 'Druid of the Flame', $sets['BRM']),
            new Card(2295, 'Volcanic Lumberer', $sets['BRM']),

            new Card(2780, 'Savage Combatant', $sets['TGT']),
            new Card(2782, 'Darnassus Aspirant', $sets['TGT']),
            new Card(2783, 'Druid of the Saber', $sets['TGT']),
            new Card(2785, 'Astral Communion', $sets['TGT']),
            new Card(2786, 'Wildwalker', $sets['TGT']),
            new Card(2788, 'Knight of the Wild', $sets['TGT']),
            new Card(2792, 'Living Roots', $sets['TGT']),
            new Card(2793, 'Mulch', $sets['TGT']),

            new Card(2922, 'Mounted Raptor', $sets['LOE']),
            new Card(2923, 'Jungle Moonkin', $sets['LOE']),
            new Card(13335, 'Raven Idol', $sets['LOE']),

            new Card(38334, 'Feral Rage', $sets['OG']),
            new Card(38337, 'Mark of Y\'Shaarj', $sets['OG']),
            new Card(38340, 'Forbidden Ancient', $sets['OG']),
            new Card(38621, 'Klaxxi Amber-Weaver', $sets['OG']),
            new Card(38655, 'Wisps of the Old Gods', $sets['OG']),
            new Card(38718, 'Mire Keeper', $sets['OG']),
            new Card(38882, 'Dark Arakkoa', $sets['OG']),
            new Card(38916, 'Addled Grizzly', $sets['OG']),

            new Card(39350, 'Enchanted Raven', $sets['KARA']),
            new Card(39696, 'Menagerie Warden', $sets['KARA']),
            new Card(39714, 'Moonglade Portal', $sets['KARA']),

            new Card(40372, 'Jade Idol', $sets['GANGS']),
            new Card(40397, 'Mark of the Lotus', $sets['GANGS']),
            new Card(40401, 'Pilfered Power', $sets['GANGS']),
            new Card(40404, 'Celestial Dreamer', $sets['GANGS']),
            new Card(40523, 'Jade Blossom', $sets['GANGS']),
            new Card(40615, 'Lunar Visions', $sets['GANGS']),
            new Card(40641, 'Virmen Sensei', $sets['GANGS']),
            new Card(40797, 'Jade Behemoth', $sets['GANGS']),
        ];
    }
}
