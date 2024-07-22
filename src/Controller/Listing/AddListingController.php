<?php
// src/Controller/Listing/AddListingController.php

namespace App\Controller\Listing;

use App\Entity\Listing;
use App\Entity\Property;
use App\Entity\PropertyFeatures;
use App\Entity\Image;
use App\Entity\User;
use App\Form\ListingStep1Type;
use App\Form\ListingStep2Type;
use App\Form\ListingStep3Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Response;

class AddListingController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/add-listing/step/1', name: 'app_add_listing_step1')]
    #[IsGranted('ROLE_USER')]
    public function newStep1(Request $request, SessionInterface $session): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('account_create'); // Route to account creation page
        }

        $formData = $session->get('step1Data', []);
        $form = $this->createForm(ListingStep1Type::class, $formData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $session->set('step1Data', $data);
            $session->set('userId', $user->getId());

            // Debugging
            //dd($session->all());

            return $this->redirectToRoute('app_add_listing_step2');
        }

        return $this->render('property/listing/addListing_step1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-listing/step/2', name: 'app_add_listing_step2')]
    #[IsGranted('ROLE_USER')]
    public function newStep2(Request $request, SessionInterface $session): Response
    {
        if (!$session->has('step1Data') || !$session->has('userId')) {
            return $this->redirectToRoute('app_add_listing_step1');
        }

        $formData = $session->get('step2Data', []);
        $form = $this->createForm(ListingStep2Type::class, $formData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $session->set('step2Data', $data);

            // Debugging
            dd($session->all());

            return $this->redirectToRoute('app_add_listing_step3');
        }

        return $this->render('property/listing/addListing_step2.html.twig', [
            'form' => $form->createView(),
            'previous_route' => 'app_add_listing_step1'
        ]);
    }

    #[Route('/add-listing/step/3', name: 'app_add_listing_step3')]
    #[IsGranted('ROLE_USER')]
    public function newStep3(Request $request, SessionInterface $session): Response
    {
        if (!$session->has('step2Data') || !$session->has('userId')) {
            return $this->redirectToRoute('app_add_listing_step1');
        }

        $formData = $session->get('step3Data', []);
        $form = $this->createForm(ListingStep3Type::class, $formData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $step1Data = $session->get('step1Data');
            $step2Data = $session->get('step2Data');
            $step3Data = $form->getData();
            $userId = $session->get('userId');

            // Debugging
            //dd($session->all());

            // Final processing and data persistence
            $listing = new Listing();
            $property = new Property();
            $propertyFeatures = new PropertyFeatures();
            $image = new Image();

            // Data mapping
            $listing->setListingTitle($step1Data['listing_title']);
            $property->setDateMutation($step1Data['date_mutation']);
            $propertyFeatures->setTypeOfRooms($step1Data['type_of_rooms']);

            $propertyFeatures->setNumberOfBedrooms($step2Data['number_of_bedrooms']);
            $propertyFeatures->setFloor($step2Data['floor']);
            $propertyFeatures->setPropertyCondition($step2Data['property_condition']);
            $image->setImgUrl($step2Data['img_url']);

            $property->setNatureMutation($step3Data['nature_mutation']);
            $propertyFeatures->setHeatingType($step3Data['heating_type']);
            $propertyFeatures->setEnergyClass($step3Data['energy_class']);
            $propertyFeatures->setElevator($step3Data['elevator']);

            $listing->addProperty($property); // Add Property to Listing
            $property->setPropertyFeatures($propertyFeatures);
            $property->addImage($image);

            // Get the user and associate it with the listing
            $user = $this->entityManager->getRepository(User::class)->find($userId);
            $listing->setUser($user);

            $this->entityManager->persist($listing);
            $this->entityManager->persist($propertyFeatures);
            $this->entityManager->persist($property);
            $this->entityManager->persist($image);
            $this->entityManager->flush();

            // Clear session data after successful submission
            $session->remove('step1Data');
            $session->remove('step2Data');
            $session->remove('step3Data');
            $session->remove('userId');

            return $this->redirectToRoute('success_page'); // Create a route for the success page
        }

        return $this->render('property/listing/addListing_step3.html.twig', [
            'form' => $form->createView(),
            'previous_route' => 'app_add_listing_step2'
        ]);
    }
}
