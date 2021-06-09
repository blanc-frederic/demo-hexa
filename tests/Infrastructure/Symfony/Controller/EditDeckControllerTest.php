<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditDeckControllerTest extends WebTestCase
{
    public function testDeckEdition(): void
    {
        $client = static::createClient();

        $client->request('GET', '/deck/test');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Test deck');
    }

    public function testAddAndRemoveCard(): void
    {
        $client = static::createClient();
        $client->followRedirects();

        $client->request('POST', '/deck/test', [
            'action' => 'add',
            'number' => '254'
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains(
            '#deck_content td:nth-of-type(2)',
            'Innervate',
            'First card in deck "Test" must be an "Innervate"'
        );

        $client->request('POST', '/deck/test', [
            'action' => 'remove',
            'number' => '254'
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorNotExists('#deck_content td');
    }

    public function testTooManyCopies(): void
    {
        $client = static::createClient();
        $client->followRedirects();

        $client->request('GET', '/deck/test');
        for ($i = 1; $i <= 3; $i++) {
            $client->submitForm('Add');
        }

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains(
            '.alert-danger',
            'Deck can only contain 2 copies of the same card'
        );

        for ($i = 1; $i <= 2; $i++) {
            $client->submitForm('Remove');
        }
    }
}
