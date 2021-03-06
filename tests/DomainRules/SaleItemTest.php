<?php

namespace Tests\DomainRules;
use Application\Provider\DoctrineOrmProvider;
use Data\Entity\Person;
use Data\Entity\Product;
use Data\Entity\Sale;
use Data\Entity\SaleItem;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Doctrine\ORM\EntityManager;
use Doctrine\Tests\DoctrineTestCase;
use PHPUnit\Framework\TestCase;
use Tests\TestBase;


/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 00:03
 */
class SaleItemTest extends TestCase
{

    /**
     * @var EntityManager
     */
    protected $_em;


    protected function setUp()
    {
        $this->_em = DoctrineOrmProvider::bootstrapCliConnection();
    }

    /**
     *  Testing total value generated by trigger
     */
    public function testVerifyTotalPrice()
    {
        $tempTotal = 0;

        $client = $this->_em->getRepository(Person::class)->findOneBy([]);
        $this->assertNotNull($client);
        $product = $this->_em->getRepository(Product::class)->findOneBy([]);
        $this->assertNotNull($product);

        $sale = new Sale();
        $sale->setClient($client);
        $sale->setDate(new \DateTime());
        $sale->setNumber(rand(1,2222));
        $sale->setTotal(999);
        $sale->setCreatedBy('rmncst');
        $this->_em->persist($sale);

        $saleItem = new SaleItem();
        $saleItem->setProduct($product);
        $saleItem->setCount(3);
        $saleItem->setUnitPrice($product->getUnitPrice());
        $saleItem->setSale($sale);
        $saleItem->setCreatedBy('rmncst');

        $saleItem2 = new SaleItem();
        $saleItem2->setProduct($product);
        $saleItem2->setCount(3);
        $saleItem2->setPercentDiscount(0.4);
        $saleItem2->setUnitPrice($product->getUnitPrice());
        $saleItem2->setSale($sale);
        $saleItem2->setCreatedBy('rmncst');

        $this->_em->getRepository(Sale::class)->updateTotal($sale);

        $this->assertEquals(3 * $product->getUnitPrice(),$saleItem->getTotal());
        $this->assertEquals((3 * $product->getUnitPrice()) * 0.6,$saleItem2->getTotal());

        $this->_em->persist($saleItem);
        $this->_em->persist($saleItem2);


        $this->_em->flush();
        $this->assertEquals($tempTotal,$sale->getTotal());
    }


    public function testErrorCountMinorOne()
    {
        $this->expectException(InvalidArgumentException::class);
        $saleItem = new SaleItem();
        $saleItem->setCount(0);
    }

    public function testErrorPercentDiscountMinorZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $saleItem = new SaleItem();
        $saleItem->setPercentDiscount(-0.1);
    }

    public function testErrorPercentDiscountMajorZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $saleItem = new SaleItem();
        $saleItem->setPercentDiscount(1.1);
    }

    public function testErrorUnitPriceMinorZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $saleItem = new SaleItem();
        $saleItem->setUnitPrice(-0.1);
    }
}