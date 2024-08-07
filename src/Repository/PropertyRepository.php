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
        // If a parameter is set, a SQL querry is made with those parameters
        if (isset($parameters['code_postal'])) {
            $code_postal = intval($parameters['code_postal']);
            $qb->andWhere('p.code_postal = :code_postal')
                ->setParameter('code_postal', $code_postal);
        }

        if (isset($parameters['surface_reelle_bati_min']) && isset($parameters['surface_reelle_bati_max'])) {
            $surface_reelle_bati_max = intval($parameters['surface_reelle_bati_max']);
            $surface_reelle_bati_min = intval($parameters['surface_reelle_bati_min']);
            $qb->andWhere('p.surface_reelle_bati BETWEEN :surface_reelle_bati_min AND :surface_reelle_bati_max')
                ->setParameter('surface_reelle_bati_min', $surface_reelle_bati_min)
                ->setParameter('surface_reelle_bati_max', $surface_reelle_bati_max);
        }

        if (isset($parameters['nb_of_bedrooms'])) {
            // Joining on the property_features table where the number of bedrooms field is set
            $nb_of_bedrooms = $parameters['nb_of_bedrooms'];
            $qb->innerJoin('p.propertyFeatures', 'f')
                ->andWhere('f.number_of_bedrooms = :nb_of_bedrooms')
                ->setParameter('nb_of_bedrooms', $nb_of_bedrooms);
        }

        if (isset($parameters['valeur_fonciere'])) {
            $valeur_fonciere_max = $parameters['valeur_fonciere'];
            $qb->andWhere('p.valeur_fonciere < :valeur_fonciere_max')
                ->setParameter('valeur_fonciere_max', $valeur_fonciere_max);
        }
        // This will filter the listings to display only those that have the status 'active'
        if (isset($parameters['only_active_listings']) && $parameters['only_active_listings'] == 1) {
            // dd($parameters);
            $status = 'active';
            $qb->innerJoin('p.listings', 'l')
                ->andWhere('l.status = :status')
                ->setParameter('status', $status);
        }
        // returns the filtered querrybuilder
        return $qb->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
