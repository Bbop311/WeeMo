<?php

namespace App\Controller;

use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use App\Service\propertyListGenerator;
use Knp\Component\Pager\PaginatorInterface;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, PropertyRepository $propertyRepository, PaginatorInterface $paginator, int $page = 1): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);


        $properties = [];
        if ($form->isSubmitted() && $form->isValid()) {
            // The parameters are assigned to an array that will be pased in the url
            $parameters['code_postal'] = $form->get('code_postal')->getData();
            $parameters['nb_of_bedrooms'] = $form->get('nb_of_bedrooms')->getData();
            $parameters['surface_reelle_bati_min'] = $form->get('surface_reelle_bati_min')->getData();
            $parameters['surface_reelle_bati_max'] = $form->get('surface_reelle_bati_max')->getData();
            $parameters['valeur_fonciere'] = $form->get('valeur_fonciere')->getData();
            $parameters['only_active_listings'] = $form->get('only_active_listings')->getData();
            return $this->redirectToRoute('property_display', [
                // makes the array parameters in a string that can be passed in the url
                'parameters' => http_build_query($parameters),
            ]);
        }

        $queryBuilder = $propertyRepository->createQueryBuilder('p');
        $queryBuilder->orderBy('p.id', 'ASC');
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page',1),
            24
        );
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'pagination' => $pagination,
            'form' => $form,
        ]);
    }
    
    #[Route('/property/{id}', name:'property_show')]
    public function property_show(PropertyRepository $propertyRepository, int $id): Response
    {
        $property = $propertyRepository->find($id);
        return $this->render('property/property.html.twig', [
            'property' => $property
        ]);
    }

    #[Route('/property_display/{parameters}', name: 'property_display')]
    public function property_display(PropertyRepository $propertyRepository, string $parameters, Request $request, PaginatorInterface $paginator): Response
    {
        // decodes the string that was passed in the URL
        parse_str($parameters, $array);
        // This function filters the results from the database with the parameters given by the user
        $queryBuilder = $propertyRepository->filter($array);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page',1),
            24
        );
        return $this->render('home/property_display.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $propertyRepository,
            'pagination' => $pagination,
        ]);
    }
}
