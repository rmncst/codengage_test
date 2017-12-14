<?php

namespace Data\Entity;

use Data\Common\TraitAudit;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
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
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count = 1;

    /**
     * @var
     *
     * @ORM\Column(name="unitPrice", type="decimal", precision=10 , scale=2 , nullable=false)
     */
    private $unitPrice;

    /**
     * @var
     *
     * @ORM\Column(name="percent_discount", type="decimal", precision=10 , scale=2 , nullable=false)
     */
    private $percentDiscount = 0;

    /**
     * @var
     *
     * @ORM\Column(name="total", type="decimal", precision=10 , scale=2 , nullable=false)
     */
    private $total;

    use TraitAudit;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTotal()
    {
        $this->total = ($this->count * $this->unitPrice) * (1 - $this->percentDiscount);
    }

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
        if(!($count > 0))
        {
            throw new InvalidArgumentException('this value must be greater than 0');
        }

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
        if(!($unitPrice > 0))
        {
            throw new InvalidArgumentException('this value must be greater than 0');
        }

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
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        $this->updateTotal();

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

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return SaleItem
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SaleItem
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateBy
     *
     * @param string $updateBy
     * @return SaleItem
     */
    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;

        return $this;
    }

    /**
     * Get updateBy
     *
     * @return string 
     */
    public function getUpdateBy()
    {
        return $this->updateBy;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return SaleItem
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set percentDiscount
     *
     * @param float $percentDiscount
     * @return SaleItem
     */
    public function setPercentDiscount($percentDiscount)
    {
        if($percentDiscount > 1 || $percentDiscount < 0)
        {
            throw new InvalidArgumentException('this value must be between 0 and 1');
        }

        $this->percentDiscount = $percentDiscount;

        return $this;
    }

    /**
     * Get percentDiscount
     *
     * @return string 
     */
    public function getPercentDiscount()
    {
        return $this->percentDiscount;
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
}
