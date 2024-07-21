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
        $qb = $this->createQueryBuilder('p');
        // I'm using isset here to check if the parameter has been given by the user (I should be able to check if the parameter is null but symfony seems to consider that nulll =not set)
        if (isset($parameters['code_postal'])) {
            $code_postal = intval($parameters['code_postal']);
            $qb->andWhere('p.code_postal = :code_postal')
                ->setParameter('code_postal', $code_postal);
            //    ->setMaxResults(10)
        }if (isset($parameters['surface_reelle_bati_min']) && isset($parameters['surface_relle_bati_max'])) {
            $surface_reelle_bati_max = intval($parameters['surface_reelle_bati_max']);
            $surface_reelle_bati_min = intval($parameters['surface_reelle_bati_min']);
            $qb->andWhere('p.surface_reelle_bati BETWEEN :surface_reelle_batin_min AND :surface_reelle_batin_max')
                ->setParameter('surface_reelle_bati_min', $surface_reelle_bati_min)
                ->setParameter('surface_reelle_bati_max', $surface_reelle_bati_max);
            //    ->setMaxResults(10)
        }
        if (isset($parameters['nb_of_bedrooms'])) {
            // Joining on the property_features table where the number of bedrooms field is set
            $nb_of_bedrooms = $parameters['nb_of_bedrooms'];
            $qb->innerJoin('p.propertyFeatures', 'f')
                ->andWhere('f.number_of_bedrooms = :nb_of_bedrooms')
                ->setParameter('nb_of_bedrooms', $nb_of_bedrooms);
        }

        return $qb->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();

    }
}
