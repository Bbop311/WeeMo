<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\PropertyFeatures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\PropertyFixtures;

class PropertyFeatureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $propertyfeatures = [
            [
                "id" => 1,
                "property_id" => 1010,
                "type_of_rooms" => "T3",
                "number_of_bedrooms" => 3,
                "floor" => 2,
                "property_condition" => "good",
                "energy_class" => "B",
                "elevator" => true,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "gas",
                "air_condition" => false
            ],
            [
                "id" => 2,
                "property_id" => 1011,
                "type_of_rooms" => "T1",
                "number_of_bedrooms" => 1,
                "floor" => 3,
                "property_condition" => "needs renovation",
                "energy_class" => "C",
                "elevator" => false,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => true
            ],
            [
                "id" => 3,
                "property_id" => 1012,
                "type_of_rooms" => "studio",
                "number_of_bedrooms" => 1,
                "floor" => 1,
                "property_condition" => "new",
                "energy_class" => "A",
                "elevator" => true,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "central",
                "air_condition" => true
            ],
            [
                "id" => 4,
                "property_id" => 1013,
                "type_of_rooms" => "T4",
                "number_of_bedrooms" => 4,
                "floor" => 4,
                "property_condition" => "good",
                "energy_class" => "D",
                "elevator" => false,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "wood",
                "air_condition" => false
            ],
            [
                "id" => 5,
                "property_id" => 1014,
                "type_of_rooms" => "T2",
                "number_of_bedrooms" => 2,
                "floor" => 5,
                "property_condition" => "needs renovation",
                "energy_class" => "E",
                "elevator" => true,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => true
            ],
            [
                "id" => 6,
                "property_id" => 1015,
                "type_of_rooms" => "T5",
                "number_of_bedrooms" => 5,
                "floor" => 7,
                "property_condition" => "new",
                "energy_class" => "F",
                "elevator" => false,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "gas",
                "air_condition" => false
            ],
            [
                "id" => 7,
                "property_id" => 1016,
                "type_of_rooms" => "T6",
                "number_of_bedrooms" => 6,
                "floor" => 6,
                "property_condition" => "good",
                "energy_class" => "G",
                "elevator" => true,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "central",
                "air_condition" => true
            ],
            [
                "id" => 8,
                "property_id" => 1017,
                "type_of_rooms" => "T1",
                "number_of_bedrooms" => 1,
                "floor" => 1,
                "property_condition" => "needs renovation",
                "energy_class" => "A",
                "elevator" => false,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "wood",
                "air_condition" => true
            ],
            [
                "id" => 9,
                "property_id" => 1018,
                "type_of_rooms" => "T2",
                "number_of_bedrooms" => 2,
                "floor" => 1,
                "property_condition" => "new",
                "energy_class" => "B",
                "elevator" => true,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => false
            ],
            [
                "id" => 10,
                "property_id" => 1019,
                "type_of_rooms" => "studio",
                "number_of_bedrooms" => 1,
                "floor" => 2,
                "property_condition" => "good",
                "energy_class" => "C",
                "elevator" => true,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "gas",
                "air_condition" => true
            ],
            [
                "id" => 11,
                "property_id" => 1020,
                "type_of_rooms" => "T3",
                "number_of_bedrooms" => 3,
                "floor" => 3,
                "property_condition" => "needs renovation",
                "energy_class" => "D",
                "elevator" => false,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "central",
                "air_condition" => false
            ],
            [
                "id" => 12,
                "property_id" => 1021,
                "type_of_rooms" => "T4",
                "number_of_bedrooms" => 4,
                "floor" => 4,
                "property_condition" => "new",
                "energy_class" => "E",
                "elevator" => true,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "wood",
                "air_condition" => true
            ],
            [
                "id" => 13,
                "property_id" => 1022,
                "type_of_rooms" => "T5",
                "number_of_bedrooms" => 5,
                "floor" => 5,
                "property_condition" => "good",
                "energy_class" => "F",
                "elevator" => false,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => true
            ],
            [
                "id" => 14,
                "property_id" => 1023,
                "type_of_rooms" => "T6",
                "number_of_bedrooms" => 6,
                "floor" => 7,
                "property_condition" => "needs renovation",
                "energy_class" => "G",
                "elevator" => true,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "gas",
                "air_condition" => false
            ],
            [
                "id" => 15,
                "property_id" => 1024,
                "type_of_rooms" => "T3",
                "number_of_bedrooms" => 3,
                "floor" => 5,
                "property_condition" => "good",
                "energy_class" => "A",
                "elevator" => true,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "gas",
                "air_condition" => true
            ],
            [
                "id" => 16,
                "property_id" => 1025,
                "type_of_rooms" => "T2",
                "number_of_bedrooms" => 2,
                "floor" => 6,
                "property_condition" => "new",
                "energy_class" => "B",
                "elevator" => false,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => true
            ],
            [
                "id" => 17,
                "property_id" => 1026,
                "type_of_rooms" => "studio",
                "number_of_bedrooms" => 1,
                "floor" => 7,
                "property_condition" => "needs renovation",
                "energy_class" => "C",
                "elevator" => true,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "wood",
                "air_condition" => false
            ],
            [
                "id" => 18,
                "property_id" => 1027,
                "type_of_rooms" => "T1",
                "number_of_bedrooms" => 1,
                "floor" => 4,
                "property_condition" => "good",
                "energy_class" => "D",
                "elevator" => false,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "gas",
                "air_condition" => true
            ],
            [
                "id" => 19,
                "property_id" => 1028,
                "type_of_rooms" => "T4",
                "number_of_bedrooms" => 4,
                "floor" => 5,
                "property_condition" => "new",
                "energy_class" => "E",
                "elevator" => true,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => true
            ],
            [
                "id" => 20,
                "property_id" => 1029,
                "type_of_rooms" => "T5",
                "number_of_bedrooms" => 5,
                "floor" => 6,
                "property_condition" => "needs renovation",
                "energy_class" => "F",
                "elevator" => true,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "central",
                "air_condition" => false
            ],
            [
                "id" => 21,
                "property_id" => 1030,
                "type_of_rooms" => "T6",
                "number_of_bedrooms" => 6,
                "floor" => 2,
                "property_condition" => "good",
                "energy_class" => "G",
                "elevator" => false,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "gas",
                "air_condition" => true
            ],
            [
                "id" => 22,
                "property_id" => 1031,
                "type_of_rooms" => "T3",
                "number_of_bedrooms" => 3,
                "floor" => 3,
                "property_condition" => "new",
                "energy_class" => "A",
                "elevator" => true,
                "balcony" => false,
                "parking" => false,
                "heating_type" => "wood",
                "air_condition" => true
            ],
            [
                "id" => 23,
                "property_id" => 1032,
                "type_of_rooms" => "T2",
                "number_of_bedrooms" => 2,
                "floor" => 4,
                "property_condition" => "needs renovation",
                "energy_class" => "B",
                "elevator" => false,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => false
            ],
            [
                "id" => 24,
                "property_id" => 1033,
                "type_of_rooms" => "studio",
                "number_of_bedrooms" => 1,
                "floor" => 5,
                "property_condition" => "good",
                "energy_class" => "C",
                "elevator" => true,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "central",
                "air_condition" => true
            ],
            [
                "id" => 25,
                "property_id" => 1034,
                "type_of_rooms" => "T1",
                "number_of_bedrooms" => 1,
                "floor" => 6,
                "property_condition" => "new",
                "energy_class" => "D",
                "elevator" => false,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "gas",
                "air_condition" => true
            ],
            [
                "id" => 26,
                "property_id" => 1035,
                "type_of_rooms" => "T4",
                "number_of_bedrooms" => 4,
                "floor" => 7,
                "property_condition" => "needs renovation",
                "energy_class" => "E",
                "elevator" => true,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => false
            ],
            [
                "id" => 27,
                "property_id" => 1036,
                "type_of_rooms" => "T5",
                "number_of_bedrooms" => 5,
                "floor" => 2,
                "property_condition" => "good",
                "energy_class" => "F",
                "elevator" => false,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "wood",
                "air_condition" => true
            ],
            [
                "id" => 28,
                "property_id" => 1037,
                "type_of_rooms" => "T6",
                "number_of_bedrooms" => 6,
                "floor" => 3,
                "property_condition" => "new",
                "energy_class" => "G",
                "elevator" => true,
                "balcony" => true,
                "parking" => true,
                "heating_type" => "gas",
                "air_condition" => false
            ],
            [
                "id" => 29,
                "property_id" => 1038,
                "type_of_rooms" => "T3",
                "number_of_bedrooms" => 3,
                "floor" => 4,
                "property_condition" => "needs renovation",
                "energy_class" => "A",
                "elevator" => true,
                "balcony" => false,
                "parking" => true,
                "heating_type" => "electric",
                "air_condition" => true
            ],
            [
                "id" => 30,
                "property_id" => 1039,
                "type_of_rooms" => "T2",
                "number_of_bedrooms" => 2,
                "floor" => 5,
                "property_condition" => "good",
                "energy_class" => "B",
                "elevator" => false,
                "balcony" => true,
                "parking" => false,
                "heating_type" => "central",
                "air_condition" => false
            ]
        ];
    
        $i=1;
        foreach ($propertyfeatures as $propertyfeatureData) {
            $propertyfeature = new PropertyFeatures;

           $propertyfeature->setProperty($this->getReference('property_' . $i));
           $propertyfeature->setTypeOfRooms($propertyfeatureData['type_of_rooms']);
           $propertyfeature->setNumberOfBedrooms($propertyfeatureData['number_of_bedrooms']);

           $propertyfeature->setFloor($propertyfeatureData['floor']);
           $propertyfeature->setPropertyCondition($propertyfeatureData['property_condition']);
          
           $propertyfeature->setEnergyClass($propertyfeatureData['energy_class']);
           $propertyfeature->setElevator($propertyfeatureData['elevator']);
           $propertyfeature->setBalcony($propertyfeatureData['balcony']);
           $propertyfeature->setParking($propertyfeatureData['parking']);
           $propertyfeature->setHeatingType($propertyfeatureData['heating_type']);
           $propertyfeature->setAirCondition($propertyfeatureData['air_condition']);
         
           $manager->persist($propertyfeature);
           $i++;
       }
       $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            PropertyFixtures::class,
        ];
    }
}