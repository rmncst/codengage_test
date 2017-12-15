<?php

namespace Data\Entity;

use Data\Common\TraitAudit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Person
 * @package Data\Entity
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="Data\Repository\PersonRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Person
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
     * @ORM\Column(name="name" , type="string", length=128, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date" , type="date",  nullable=false )
     */
    private $birthDate;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Sale", mappedBy="client")
     */
    private $sales;

    use TraitAudit;

    public function __construct()
    {
        $this->sales = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Person
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
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return Person
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * Add sales
     *
     * @param \Data\Entity\Sale $sales
     * @return Person
     */
    public function addSale(\Data\Entity\Sale $sales)
    {
        $this->sales[] = $sales;

        return $this;
    }

    /**
     * Remove sales
     *
     * @param \Data\Entity\Sale $sales
     */
    public function removeSale(\Data\Entity\Sale $sales)
    {
        $this->sales->removeElement($sales);
    }

    /**
     * Get sales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSales()
    {
        return $this->sales;
    }
}
