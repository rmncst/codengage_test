<?php

namespace Data\Common;

/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 12/12/17
 * Time: 21:25
 */
trait TraitAudit
{
    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=220, nullable=false)
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="alterado_por", type="string", length=220, nullable=true)
     */
    private $updateBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="alterado_em", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\PrePersist
     */
    public function created()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function updated()
    {
        $this->updateAt = new \DateTime();
    }

}