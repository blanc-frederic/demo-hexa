<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DecksControllerTest extends WebTestCase
{
    public function testDeckList(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Decks list');
    }
}
