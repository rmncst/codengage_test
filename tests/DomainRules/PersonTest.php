<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 16/12/17
 * Time: 01:25
 */

namespace Tests\DomainRules;


use Application\Provider\DoctrineOrmProvider;
use Data\Entity\Person;
use Data\Entity\Product;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\Client;

class PersonTest extends TestCase
{
    /**
     * @var EntityManager
     */
    protected $_em;


    protected function setUp()
    {
        $this->_em = DoctrineOrmProvider::bootstrapCliConnection();
    }

    public function testErrorDuplicateName()
    {
        $this->expectException(\Exception::class);

        $client = $this->_em->getRepository(Person::class)->findOneBy([]);

        $duplicateClientOnName = new Person();
        $duplicateClientOnName->setName($client->getName());
        $duplicateClientOnName->setBirthDate(new \DateTime());

        $this->_em->persist($duplicateClientOnName);
        $this->_em->flush();
    }

}