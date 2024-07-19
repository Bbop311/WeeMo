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
    public function filter(array $parameters): array
    {
        if ($parameters) {
            $code_postal = intval($parameters['code_postal']);
            $nb_of_bedrooms = $parameters['nb_of_bedrooms'];
            return $this->createQueryBuilder('p')
                ->innerJoin('p.propertyFeatures', 'f')
                ->where('f.number_of_bedrooms = :nb_of_bedrooms')
                ->setParameter('nb_of_bedrooms', $nb_of_bedrooms)
                ->andWhere('p.code_postal = :code_postal')
                ->setParameter('code_postal', $code_postal)
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
    // public function findByNumberOfRooms($number_of_rooms): array
    // {
    //     if ($code_postal) {
    //         $code_postal = intval($code_postal);
    //         return $this->createQueryBuilder('p')
    //             ->andWhere('p.property_features.nb_of_bedrooms = :val')
    //             ->setParameter('val', $code_postal)
    //             ->orderBy('p.id', 'ASC')
    //             //    ->setMaxResults(10)
    //             ->getQuery()
    //             ->getResult();
    //     }
    // }
}
