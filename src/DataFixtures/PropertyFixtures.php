<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Property;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use PDO;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\UserFixtures;

class PropertyFixtures extends Fixture implements DependentFixtureInterface
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, )
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Code taken from Julien, it uses a database "recupdb" to load the fixtures with everything in the database, it requires the recupdb database to exist though (with the dump imported)
        $dbUser = "root";
        $dbPwd = "root";

        $pdoDb = new PDO('mysql:host=127.0.0.1; dbname=recupdb', $dbUser, $dbPwd);
        $smt = $pdoDb->prepare('SELECT * FROM property');
        $smt->execute();
        $immos = $smt->fetchAll();

        $i=1;
        foreach ($immos as $immo) {
            $property = new Property();
            $property
            ->setNatureMutation($immo['nature_mutation'])
            ->setDateMutation($immo['date_mutation'])
            ->setValeurFonciere($immo['valeur_fonciere'])
            ->setNoVoie($immo['no_voie'])
            ->setBTQ($immo['b_t_q'])
            ->setTypeVoie($immo['type_voie'])
            ->setCodeVoie($immo['code_voie'])
            ->setVoie($immo['voie'])
            ->setCodePostal($immo['code_postal'])
            ->setCommune($immo['commune'])
            ->setCodeDepartement($immo['code_departement'])
            ->setCodeCommune($immo['code_commune'])
            ->setSection($immo['section'])
            ->setNbLots($immo['nb_lots'])
            ->setCodeTypeLocal($immo['code_type_local'])
            ->setTypeLocal($immo['type_local'])
            ->setSurfaceReelleBati($immo['surface_reelle_bati'])
            ->setNbPieces($immo['nb_pieces'])
            ->setSurfaceTerrain($immo['surface_terrain'])
            ->setUser($this->getReference('user_' . rand(0, count(UserFixtures::USERS)-1)));

            $manager->persist($property);

            $this->addReference('property_' . $i, $property);
            $i++;
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

}

    

