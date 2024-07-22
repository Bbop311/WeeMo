<?php

namespace App\Controller;

use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use App\Service\propertyListGenerator;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticator;



class HomeController extends AbstractController
{
    #[Route('/home/{page}', name: 'app_home')]
    public function index(TotpAuthenticator $TotpAuthenticator, Request $request, PropertyRepository $propertyRepository, propertyListGenerator $propertyListGenerator, int $page = 1): Response
    {
        // dd($TotpAuthenticator->generateSecret());

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        $properties_list = $propertyListGenerator->getList($propertyRepository);
        $properties = [];
        for ($i = 24*($page-1) ; $i < 24*($page) ;$i++ )
        {
            $properties[] = $properties_list[$i];
        }
        dump($form);
        if($request->getMethod() === 'POST') dd($form->isValid()) ;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dd($data);
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $properties,
            'page' => $page,
            'form' => $form,
        ]);
    }

    #[Route('/', name: 'home')]
    public function redirect_to_home(): Response
    {
        return $this->redirectToRoute('app_home');
    }

    #[Route('/property/{id}', name:'property_show')]
    public function property_show(PropertyRepository $propertyRepository, int $id): Response
    {
        $property = $propertyRepository->find($id);
        return $this->render('property/property.html.twig', [
            'property' => $property
        ]);
    }
}
