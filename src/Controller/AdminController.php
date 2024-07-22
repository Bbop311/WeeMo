<?php

namespace App\Controller;

use App\Form\ListingValidationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ListingRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function adminDashboard(ListingRepository $listingRepository): Response
    {
        $listings = $listingRepository->findAll();
    
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        return $this->render('admin/index.html.twig', [
            'listings' => $listings,
        
            'controller_name' => 'AdminController'
        ]);
    }
    
    #[Route('/listing_validation/{listing_id}', name: 'listing_validation')]
    public function listing_validation(Request $request, ListingRepository $listingRepository, int $listing_id, EntityManagerInterface $entityManager): Response
    {
        $listing = $listingRepository->find($listing_id);

        $form = $this->createForm(ListingValidationType::class, $listing);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $listing->setStatus($form->get('status')->getData());
         
        }
        $entityManager->persist($listing);
        $entityManager->flush();
        
        return $this->render('admin/listing_validation.html.twig', [
            'form' => $form,
            'listing' => $listing,
           
        ]);
    }
}
