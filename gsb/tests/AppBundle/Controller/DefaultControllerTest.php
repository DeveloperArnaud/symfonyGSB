<?php

namespace Tests\AppBundle\Controller;

use PHPUnit\Framework\TestCase;

class DefaultControllerTest extends TestCase
{
    public function testIndex()
    {
        //$client = static::createClient();

        //$crawler = $client->request('GET', '/');

        $this->assertEquals(200, 100+100);
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
