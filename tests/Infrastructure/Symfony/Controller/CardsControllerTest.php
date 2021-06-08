<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardsControllerTest extends WebTestCase
{
    public function testCardList(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cards');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Cards list');
        $this->assertCount(64, $crawler->filter('tbody tr'));
    }
}
