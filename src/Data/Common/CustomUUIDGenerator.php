<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 12/12/17
 * Time: 21:29
 */

namespace Data\Common;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

class CustomUUIdGenerator extends AbstractIdGenerator
{

    /**
     * Generate based Id UUID
     *
     * @return string
     */
    public static function generateId()
    {
        return uniqid(rand(1,999));
    }

    /**
     * @inheritdoc
     */
    public function generate(EntityManager $em, $entity)
    {
        return static::generateId();
    }

    public function isPostInsertGenerator()
    {
        return parent::isPostInsertGenerator();
    }
}