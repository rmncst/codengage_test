<?php


namespace Data\Entity;

use Data\Common\TraitAudit;
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
    * @ORM\CustomIdGenerator(class="Data\Common\CustomUUIDGenerator")
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
     * @ORM\Column(name="name" , type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="unit_price", type="decimal", precision=10 , scale=2 ,  nullable=false)
     */
    private $unitPrice;

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
}
