<?php

namespace Data\Event;
use Data\Entity\Sale;
use Data\Entity\SaleItem;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 01:14
 */
class UpdateTotalSaleEvent implements EventSubscriber
{

    /**
     * @inheritdoc
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::postUpdate,
        );
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $em = $args->getObjectManager();

        if ($entity instanceof Sale)
        {
            $entity->updateTotal();
            $em->merge($entity);
        }
        else if ($entity instanceof SaleItem)
        {
            $entity->getSale()->updateTotal();
            $em->merge($entity);
        }
    }
}