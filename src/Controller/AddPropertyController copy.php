<?php

// src/Controller/AddPropertyController.php

namespace App\Controller;

use App\Entity\Listing;
use App\Entity\Property;
use App\Entity\PropertyFeatures;
use App\Entity\Image;
use App\Form\ListingFullType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AddPropertyController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/add-property', name: 'app_add_property')]
    #[IsGranted('ROLE_USER')]
    public function addProperty(Request $request): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('account_create');
        }

        $form = $this->createForm(ListingFullType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $listing = new Listing();
            $property = new Property();
            $propertyFeatures = new PropertyFeatures();
            $image = new Image();

            $listing->setListingTitle($data['listing_title']);
            $property->setDateMutation($data['date_mutation']->format('Y-m-d')); // Convert DateTime to string
            $property->setNatureMutation($data['nature_mutation']);

            $propertyFeatures->setTypeOfRooms($data['type_of_rooms']);
            $propertyFeatures->setNumberOfBedrooms($data['number_of_bedrooms']);
            $propertyFeatures->setFloor($data['floor']);
            $propertyFeatures->setPropertyCondition($data['property_condition']);
            $propertyFeatures->setHeatingType($data['heating_type']);
            $propertyFeatures->setEnergyClass($data['energy_class']);
            $propertyFeatures->setElevator($data['elevator']);

            $image->setImgUrl($data['img_url']);

            //$listing->addProperty($property);
            $listing->setProperty($property);
            $property->setPropertyFeatures($propertyFeatures);
            $property->addImage($image);
            
             // Set the user
            //$listing->setUser($user);
            $property->setUser($user);
            $this->entityManager->persist($listing);
            $this->entityManager->persist($propertyFeatures);
            $this->entityManager->persist($property);
            $this->entityManager->persist($image);
            $this->entityManager->flush();

            return $this->redirectToRoute('success_page');
        }

        return $this->render('addProperty/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
