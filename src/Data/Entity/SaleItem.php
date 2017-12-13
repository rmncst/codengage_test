<?php

namespace Data\Entity;

use Data\Common\TraitAudit;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Sale
 * @package Data\Entity
 *
 * @ORM\Table(name="sale_item")
 * @ORM\Entity(repositoryClass="Data\Repository\SaleItemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SaleItem
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=24, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Data\Common\CustomUUIDGenerator")
     */
    private $id;

    /**
     * @var Sale
     *
     * @ORM\ManyToOne(targetEntity="Sale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $sale;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $product;

    /**
     * @var
     *
     * @ORM\Column(name="count", type="integer", nullable=false, options={"unsigned":true})
     */
    private $count;

    /**
     * @var
     *
     * @ORM\Column(name="unitPrice", type="decimal", precision=10 , scale=2 , nullable=false)
     */
    private $unitPrice;

    /**
     * @var
     *
     * @ORM\Column(name="total", type="decimal", precision=10 , scale=2 , nullable=false)
     */
    private $total;

    use TraitAudit;

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return SaleItem
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set unitPrice
     *
     * @param string $unitPrice
     * @return SaleItem
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return string 
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return SaleItem
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set sale
     *
     * @param \Data\Entity\Sale $sale
     * @return SaleItem
     */
    public function setSale(\Data\Entity\Sale $sale)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return \Data\Entity\Sale 
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * Set product
     *
     * @param \Data\Entity\Product $product
     * @return SaleItem
     */
    public function setProduct(\Data\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Data\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
