<?php


namespace Data\Entity;

use Data\Common\TraitAudit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package Data\Entity
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Data\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Product
{
    /**
    * @var string
    *
    * @ORM\Column(name="id", type="string", length=24, nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="CUSTOM")
    * @ORM\CustomIdGenerator(class="Data\Common\UUIDGeneratorCommon")
    */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code" , type="string", length=64, nullable=false, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name" , type="string", length=128, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="unit_price", type="decimal", precision=10 , scale=2 ,  nullable=false)
     */
    private $unitPrice;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SaleItem", mappedBy="product")
     */
    private $saleItems;

    use TraitAudit;

    public function __construct()
    {
        $this->saleItems = new ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set unitPrice
     *
     * @param string $unitPrice
     * @return Product
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
     * Set createdBy
     *
     * @param string $createdBy
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Add saleItems
     *
     * @param \Data\Entity\SaleItem $saleItems
     * @return Product
     */
    public function addSaleItem(\Data\Entity\SaleItem $saleItems)
    {
        $this->saleItems[] = $saleItems;

        return $this;
    }

    /**
     * Remove saleItems
     *
     * @param \Data\Entity\SaleItem $saleItems
     */
    public function removeSaleItem(\Data\Entity\SaleItem $saleItems)
    {
        $this->saleItems->removeElement($saleItems);
    }

    /**
     * Get saleItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSaleItems()
    {
        return $this->saleItems;
    }
}
