<?php

namespace Tests;

use Application\Provider\ApplicationProvider;
use Application\Provider\DoctrineOrmProvider;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Silex\Application;
use Silex\WebTestCase;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\HttpKernel\HttpKernelInterface;


/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 00:07
 */
class TestBase extends TestCase
{
    /**
     * @var EntityManager
     */
    protected $_em;


    protected function setUp()
    {
        $this->_em = DoctrineOrmProvider::bootstrapCliConnection();
    }


    public function createApplication()
    {
        $app = new Application();
        $app->register(new ApplicationProvider());

        return $app;
    }

    public function createClient()
    {
        $client = new Client($this->createApplication(), array());
        return $client;
    }

    public function testInitialPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('h1:contains("Menu")'));
    }
}