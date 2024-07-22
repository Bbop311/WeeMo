<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Images extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $images=[
           
                [
                    "property_id" => 1,
                    "img_url" => "assets/images/1.jpeg"
                ],
                [
                    "property_id" => 2,
                    "img_url" => "assets/images/2.jpeg"
                ],
                [
                    "property_id" => 3,
                    "img_url" => "assets/images/3.jpeg"
                ],
                [
                    "property_id" => 4,
                    "img_url" => "assets/images/5.jpeg"
                ],
                [
                    "property_id" => 5,
                    "img_url" => "assets/images/6.jpeg"
                ],
                [
                    "property_id" => 6,
                    "img_url" => "https://example.com/img6.jpg"
                ],
                [
                    "property_id" => 7,
                    "img_url" => "https://example.com/img7.jpg"
                ],
                [
                    "property_id" => 8,
                    "img_url" => "https://example.com/img8.jpg"
                ],
                [
                    "property_id" => 9,
                    "img_url" => "https://example.com/img9.jpg"
                ],
                [
                    "property_id" => 10,
                    "img_url" => "https://example.com/img10.jpg"
                ],
                [
                    "property_id" => 11,
                    "img_url" => "https://example.com/img11.jpg"
                ],
                [
                    "property_id" => 1021,
                    "img_url" => "https://example.com/img12.jpg"
                ],
                [
                    "property_id" => 1022,
                    "img_url" => "https://example.com/img13.jpg"
                ],
                [
                    "property_id" => 12,
                    "img_url" => "https://example.com/img14.jpg"
                ],
                [
                    "property_id" => 13,
                    "img_url" => "assets/images/1.jpeg"
                ],
                [
                    "property_id" => 14,
                    "img_url" => "https://example.com/img16.jpg"
                ],
                [
                    "property_id" => 15,
                    "img_url" => "https://example.com/img17.jpg"
                ],
                [
                    "property_id" => 16,
                    "img_url" => "https://example.com/img18.jpg"
                ],
                [
                    "property_id" => 17,
                    "img_url" => "https://example.com/img19.jpg"
                ],
                [
                    "property_id" => 18,
                    "img_url" => "https://example.com/img20.jpg"
                ],
                [
                    "property_id" => 19,
                    "img_url" => "https://example.com/img19.jpg"
                ],
                [
                    "property_id" => 20,
                    "img_url" => "https://example.com/img20.jpg"
                ]
            ];
            
      
        // $product = new Product();
        // $manager->persist($product);
        foreach ($images as $imageData) {
            $image = new Image;
           
            $image->setImgUrl($imageData['img_url']);
           // $image->setProperty_id($imageData['property_id']);
           

    
            $manager->persist($image);
        }
        $manager->flush();

    
    }
}
