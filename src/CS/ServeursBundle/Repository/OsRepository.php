<?php

namespace CS\ServeursBundle\Repository;
use  Doctrine\ORM\Tools\Pagination\Paginator ;


class OsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getList($page=1, $maxperpage=20)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('os')
            ->from('CSServeursBundle:Os','os')
        ;

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }
}
