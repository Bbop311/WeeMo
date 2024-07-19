<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Property>
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findByArrondissement($code_postal): array
    {
        if ($code_postal) {
            $code_postal = intval($code_postal);
            return $this->createQueryBuilder('p')
                ->andWhere('p.code_postal = :val')
                ->setParameter('val', $code_postal)
                ->orderBy('p.id', 'ASC')
                //    ->setMaxResults(10)
                ->getQuery()
                ->getResult();
        }

        //    public function findOneBySomeField($value): ?Property
        //    {
        //        return $this->createQueryBuilder('p')
        //            ->andWhere('p.exampleField = :val')
        //            ->setParameter('val', $value)
        //            ->getQuery()
        //            ->getOneOrNullResult()
        //        ;
        //    }
    }
}
