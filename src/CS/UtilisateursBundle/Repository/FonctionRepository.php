<?php

namespace CS\UtilisateursBundle\Repository;

use  Doctrine\ORM\Tools\Pagination\Paginator ;

/**
 * FonctionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FonctionRepository extends \Doctrine\ORM\EntityRepository
{
    public function getList($page=1, $maxperpage=20)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('fonctions')
            ->from('CSUtilisateursBundle:Fonction','fonctions')
        ;

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }

}
