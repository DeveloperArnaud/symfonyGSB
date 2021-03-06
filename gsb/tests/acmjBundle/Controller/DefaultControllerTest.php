<?php

namespace acmjBundle\Tests\Controller;

use PHPUnit\Framework\TestCase;

class DefaultControllerTest extends TestCase
{
    /**
     * Essai de test sur Symfony avec PHPUnit
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
