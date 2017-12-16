<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 16/12/17
 * Time: 01:00
 */

namespace Tests\DomainRules;


use Application\Provider\DoctrineOrmProvider;
use Data\Entity\Product;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
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

        $product = $this->_em->getRepository(Product::class)->findOneBy([]);

        $duplicateProductOnName = new Product();
        $duplicateProductOnName->setName($product->getName());
        $duplicateProductOnName->setCode(rand(1,9999));
        $duplicateProductOnName->setUnitPrice(rand(1,9999));
        $duplicateProductOnName->setCreatedBy('userTest');

        $this->_em->persist($duplicateProductOnName);
        $this->_em->flush();
    }

    public function testErrorDuplicateCode()
    {
        $this->expectException(\Exception::class);

        $product = $this->_em->getRepository(Product::class)->findOneBy([]);

        $duplicateProductOnName = new Product();
        $duplicateProductOnName->setName(md5(uniqid(1,99)));
        $duplicateProductOnName->setCode($product->getCode());
        $duplicateProductOnName->setUnitPrice(rand(1,9999));
        $duplicateProductOnName->setCreatedBy('userTest');

        $this->_em->persist($duplicateProductOnName);
        $this->_em->flush();
    }
}