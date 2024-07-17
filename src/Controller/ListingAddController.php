<?php

namespace App\Controller;

use App\Entity\Listing;
use App\Form\AddListingFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListingAddController extends AbstractController
{
    #[Route('/listing/add', name: 'app_listing_add')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $listing = new Listing();
        $form = $this->createForm(AddListingFormType::class, $listing);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listing);
            $entityManager->flush();

            return $this->redirectToRoute('listing_success'); // Vous devez créer une route pour 'listing_success'
        }


        return $this->render('listing/add.html.twig', [
            'controller_name' => 'ListingAddController',
            'form' => $form->createView(),
        ]);

        
    }
}
