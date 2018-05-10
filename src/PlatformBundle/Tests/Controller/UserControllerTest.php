<?php

namespace PlatformBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/profil/{id}');
    }

    public function testUseredit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/profil/edit');
    }

    public function testUserdelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/profil/delete');
    }

}
