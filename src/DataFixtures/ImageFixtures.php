<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $images = [

            [
                "img_url" => "assets/images/1.jpeg"
            ],
            [
                "img_url" => "assets/images/2.jpeg"
            ],
            [
                "img_url" => "assets/images/3.jpeg"
            ],
            [
                "img_url" => "assets/images/5.jpeg"
            ],
            [
                "img_url" => "assets/images/6.jpeg"
            ],
            [
                "img_url" => "assets/images/7.jpeg"
            ],
            [
                "img_url" => "assets/images/8.jpeg"
            ],
            [
                "img_url" => "assets/images/9.jpeg"
            ],
            [
                "img_url" => "assets/images/10.jpeg"
            ],
            [
                "img_url" => "assets/images/11.jpeg"
            ],
            [
                "img_url" => "assets/images/12.jpeg"
            ]
          
        ];

        // Loops on the first 25 appartments to associate the set of images to them
        for ($i = 1; $i < 25; $i++) {
            foreach ($images as $imageData) {
                $image = new Image;

                $image->setImgUrl($imageData['img_url']);

                $image->setProperty($this->getReference('property_' . $i));
                $manager->persist($image);
            }
            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return [
            PropertyFixtures::class,
        ];






        
    }







}
