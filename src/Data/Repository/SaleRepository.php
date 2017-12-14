<?php

namespace Data\Repository;

use Data\Entity\Sale;
use Data\Entity\SaleItem;
use Doctrine\ORM\EntityRepository;

/**
 * SaleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SaleRepository extends EntityRepository
{

    public function updateTotal(Sale $sale, $flush = true)
    {
        $total = 0;

        foreach ($sale->getItems() as $item)
        {
            if(!($item instanceof SaleItem))
            {
                throw new \UnexpectedValueException('Bad value !');
            }

            $total += $item->getTotal();
        }

        $sale->setTotal($total);
        $this->_em->merge($sale);

        if($flush === true){
            $this->_em->flush();
        }
    }

    public function getNextNumberSequence()
    {
        $sql = $this->_em->getConnection()->getWrappedConnection()->prepare('
            SELECT IFNULL(max(number),1) + 1 AS NUMBER FROM sale;
        ');

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC)[0]['NUMBER'];
    }
}
