<?php

namespace App\Controller;

use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use App\Service\propertyListGenerator;


class HomeController extends AbstractController
{
    #[Route('/home/{page}', name: 'app_home')]
    public function index(Request $request, PropertyRepository $propertyRepository, propertyListGenerator $propertyListGenerator, int $page = 1): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        $properties = [];
        if ($form->isSubmitted() && $form->isValid()) {
            // $data = $form->getData();
            // dd($form->get('code_postal')->getData());
            $propertyRepository = $propertyRepository->findByArrondissement($form->get('code_postal')->getData());
            // $properties_list = $propertyListGenerator->getList($propertyRepository);
            // dd($propertyRepository);
            return $this->redirectToRoute('property_display', ['code_postal' => $form->get('code_postal')->getData(), 'page' => $page ]);
        }
        else {
            $properties_list = $propertyListGenerator->getList($propertyRepository);
            for ($i = 24 * ($page - 1); $i < 24 * ($page); $i++) {
                $properties[] = $properties_list[$i];
            }
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'properties' => $properties,
                'page' => $page,
                'form' => $form
            ]);
        }
    }

    // Helps with pagination (prevents register or login to mistaken for page numbers)
    #[Route('/', name: 'home')]
    public function redirect_to_home(): Response
    {
        return $this->redirectToRoute('app_home');
    }

    #[Route('/property/{id}', name: 'property_show')]
    public function property_show(PropertyRepository $propertyRepository, int $id): Response
    {
        $property = $propertyRepository->find($id);
        return $this->render('property/property.html.twig', [
            'property' => $property
        ]);
    }

    #[Route('/property_display/{page}/{code_postal}', name: 'property_display')]
    public function property_display(PropertyRepository $propertyRepository, int $page = 1, int $code_postal): Response
    {
        $propertyRepository = $propertyRepository->findByArrondissement($code_postal);
        for ($i = 24 * ($page - 1); $i < 24 * ($page); $i++) {
            $properties[] = $propertyRepository[$i];
        }
        // dd($properties);
        return $this->render('home/property_display.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $properties,
            'page' => $page,
        ]);
    }
}
