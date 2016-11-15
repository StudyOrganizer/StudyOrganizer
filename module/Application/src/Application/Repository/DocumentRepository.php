<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class DocumentRepository extends EntityRepository
{
    private $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function getPaginator($offset = 0, $limit = 10) {
        $qb = $this->em->createQueryBuilder();
        $qb->select('pd')
            ->from('\Application\Entity\PublicDocument', 'pd')
            ->orderBy('pd.id')
            ->setMaxResults($limit)
            ->setFirstResult($offset);
        $query = $qb->getQuery();
        $paginator = new Paginator( $query );

        return $paginator;
    }
}