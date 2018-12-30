<?php

namespace AppBundle\Repository;

abstract class AbstractEnitityRepository extends \Doctrine\ORM\EntityRepository{
 
    public function count()
    {
        $qb = $this->createQueryBuilder('t');
        return $qb
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
 