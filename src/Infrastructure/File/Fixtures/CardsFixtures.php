<?php

declare(strict_types=1);

namespace Infrastructure\File\Fixtures;

use Infrastructure\Contract\FixturesLoaderInterface;

use function Safe\file_put_contents;
use function Safe\json_encode;
use function Safe\mkdir;

class CardsFixtures implements FixturesLoaderInterface
{
    public function __construct(
        private string $dataPath
    ) {
    }

    public function getName(): string
    {
        return 'Cards fixtures';
    }

    public function isNeeded(): bool
    {
        return ! is_file($this->dataPath . '/cards.json');
    }

    public function load(): void
    {
        if (! $this->isNeeded()) {
            return;
        }

        if (! is_dir($this->dataPath)) {
            mkdir($this->dataPath, 0755, true);
        }

        file_put_contents($this->dataPath . '/cards.json', json_encode([
            ['number' => 64, 'name' => 'Swipe', 'set' => 'CORE'],
            ['number' => 205, 'name' => 'Ironbark Protector', 'set' => 'CORE'],
            ['number' => 213, 'name' => 'Mark of the Wild', 'set' => 'CORE'],
            ['number' => 254, 'name' => 'Innervate', 'set' => 'CORE'],
            ['number' => 467, 'name' => 'Moonfire', 'set' => 'CORE'],
            ['number' => 742, 'name' => 'Savage Roar', 'set' => 'CORE'],
            ['number' => 773, 'name' => 'Healing Touch', 'set' => 'CORE'],
            ['number' => 823, 'name' => 'Starfire', 'set' => 'CORE'],
            ['number' => 1050, 'name' => 'Claw', 'set' => 'CORE'],
            ['number' => 1124, 'name' => 'Wild Growth', 'set' => 'CORE'],

            ['number' => 86, 'name' => 'Starfall', 'set' => 'EXPERT1'],
            ['number' => 95, 'name' => 'Nourish', 'set' => 'EXPERT1'],
            ['number' => 151, 'name' => 'Mark of Nature', 'set' => 'EXPERT1'],
            ['number' => 233, 'name' => 'Naturalize', 'set' => 'EXPERT1'],
            ['number' => 381, 'name' => 'Soul of the Forest', 'set' => 'EXPERT1'],
            ['number' => 481, 'name' => 'Savagery', 'set' => 'EXPERT1'],
            ['number' => 493, 'name' => 'Force of Nature', 'set' => 'EXPERT1'],
            ['number' => 503, 'name' => 'Power of the Wild', 'set' => 'EXPERT1'],
            ['number' => 577, 'name' => 'Bite', 'set' => 'EXPERT1'],
            ['number' => 601, 'name' => 'Keeper of the Grove', 'set' => 'EXPERT1'],
            ['number' => 692, 'name' => 'Druid of the Claw', 'set' => 'EXPERT1'],
            ['number' => 836, 'name' => 'Wrath', 'set' => 'EXPERT1'],
            ['number' => 920, 'name' => 'Ancient of Lore', 'set' => 'EXPERT1'],
            ['number' => 1035, 'name' => 'Ancient of War', 'set' => 'EXPERT1'],

            ['number' => 1802, 'name' => 'Poison Seeds', 'set' => 'NAXX'],

            ['number' => 1995, 'name' => 'Recycle', 'set' => 'GVG'],
            ['number' => 2001, 'name' => 'Tree of Life', 'set' => 'GVG'],
            ['number' => 2002, 'name' => 'Mech-Bear-Cat', 'set' => 'GVG'],
            ['number' => 2009, 'name' => 'Dark Wispers', 'set' => 'GVG'],
            ['number' => 2048, 'name' => 'Druid of the Fang', 'set' => 'GVG'],
            ['number' => 2096, 'name' => 'Anodized Robo Cub', 'set' => 'GVG'],
            ['number' => 2225, 'name' => 'Grove Tender', 'set' => 'GVG'],

            ['number' => 2292, 'name' => 'Druid of the Flame', 'set' => 'BRM'],
            ['number' => 2295, 'name' => 'Volcanic Lumberer', 'set' => 'BRM'],

            ['number' => 2780, 'name' => 'Savage Combatant', 'set' => 'TGT'],
            ['number' => 2782, 'name' => 'Darnassus Aspirant', 'set' => 'TGT'],
            ['number' => 2783, 'name' => 'Druid of the Saber', 'set' => 'TGT'],
            ['number' => 2785, 'name' => 'Astral Communion', 'set' => 'TGT'],
            ['number' => 2786, 'name' => 'Wildwalker', 'set' => 'TGT'],
            ['number' => 2788, 'name' => 'Knight of the Wild', 'set' => 'TGT'],
            ['number' => 2792, 'name' => 'Living Roots', 'set' => 'TGT'],
            ['number' => 2793, 'name' => 'Mulch', 'set' => 'TGT'],

            ['number' => 2922, 'name' => 'Mounted Raptor', 'set' => 'LOE'],
            ['number' => 2923, 'name' => 'Jungle Moonkin', 'set' => 'LOE'],
            ['number' => 13335, 'name' => 'Raven Idol', 'set' => 'LOE'],

            ['number' => 38334, 'name' => 'Feral Rage', 'set' => 'OG'],
            ['number' => 38337, 'name' => 'Mark of Y\'Shaarj', 'set' => 'OG'],
            ['number' => 38340, 'name' => 'Forbidden Ancient', 'set' => 'OG'],
            ['number' => 38621, 'name' => 'Klaxxi Amber-Weaver', 'set' => 'OG'],
            ['number' => 38655, 'name' => 'Wisps of the Old Gods', 'set' => 'OG'],
            ['number' => 38718, 'name' => 'Mire Keeper', 'set' => 'OG'],
            ['number' => 38882, 'name' => 'Dark Arakkoa', 'set' => 'OG'],
            ['number' => 38916, 'name' => 'Addled Grizzly', 'set' => 'OG'],

            ['number' => 39350, 'name' => 'Enchanted Raven', 'set' => 'KARA'],
            ['number' => 39696, 'name' => 'Menagerie Warden', 'set' => 'KARA'],
            ['number' => 39714, 'name' => 'Moonglade Portal', 'set' => 'KARA'],

            ['number' => 40372, 'name' => 'Jade Idol', 'set' => 'GANGS'],
            ['number' => 40397, 'name' => 'Mark of the Lotus', 'set' => 'GANGS'],
            ['number' => 40401, 'name' => 'Pilfered Power', 'set' => 'GANGS'],
            ['number' => 40404, 'name' => 'Celestial Dreamer', 'set' => 'GANGS'],
            ['number' => 40523, 'name' => 'Jade Blossom', 'set' => 'GANGS'],
            ['number' => 40615, 'name' => 'Lunar Visions', 'set' => 'GANGS'],
            ['number' => 40641, 'name' => 'Virmen Sensei', 'set' => 'GANGS'],
            ['number' => 40797, 'name' => 'Jade Behemoth', 'set' => 'GANGS'],
        ]));
    }
}
