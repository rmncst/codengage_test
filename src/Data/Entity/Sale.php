<?php

namespace Data\Entity;

use Data\Common\TraitAudit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Sale
 * @package Data\Entity
 *
 * @ORM\Table(name="sale")
 * @ORM\Entity(repositoryClass="Data\Repository\SaleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Sale
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
    * @var
    *
    * @ORM\Column(name="number", type="integer", nullable=false, unique=true)
    */
    private $number;

    /**
    * @var Person
    *
    * @ORM\ManyToOne(targetEntity="Person")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
    * })
    */
    private $client;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="date", type="date", length=24, nullable=false)
    */
    private $date;

    /**
    * @var float
    *
    * @ORM\Column(name="total", type="decimal", precision=10 , scale=2 ,  nullable=false)
    */
    private $total;

    /**
     * @ORM\OneToMany(targetEntity="SaleItem", mappedBy="sale")
     */
    private $items;


    public function __construct()
    {
        $this->items = new ArrayCollection();
    }


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
     * Set number
     *
     * @param integer $number
     * @return Sale
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Sale
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return Sale
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Sale
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
     * @return Sale
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
     * @return Sale
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
     * @return Sale
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
     * Set client
     *
     * @param \Data\Entity\Person $client
     * @return Sale
     */
    public function setClient(\Data\Entity\Person $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Data\Entity\Person 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add items
     *
     * @param \Data\Entity\SaleItem $items
     * @return Sale
     */
    public function addItem(\Data\Entity\SaleItem $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Data\Entity\SaleItem $items
     */
    public function removeItem(\Data\Entity\SaleItem $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}
