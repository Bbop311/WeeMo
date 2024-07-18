<?php

// src/Controller/AddListingController.php
namespace App\Controller;

use App\Entity\Property;
use App\Form\ListingFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListingAddController extends AbstractController
{
    #[Route('/add-listing', name: 'app_listing_add')]
    public function propertyList(Request $request, EntityManagerInterface $em): Response
    //public function addListing(Request $request, EntityManagerInterface $em): Response
    {
    
        $property = new Property();

        $form = $this->createForm(ListingFormType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $property->setUser($user);

            $em->persist($property);
            $em->flush();

        // Add flash message and redirect
        // $this->addFlash('success', 'Listing added successfully!');

            return $this->redirectToRoute('listing_success'); // Adjust the route name 
          
        }

        return $this->render('listing/addListing.html.twig', [
            'controller_name' => 'ListingAddController',
            'form' => $form->createView(),
        ]);
        
    }
}