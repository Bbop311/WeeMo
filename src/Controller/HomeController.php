<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Form\SimulatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Service\ModelDVFService;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, PropertyRepository $propertyRepository, PaginatorInterface $paginator, int $page = 1): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

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
        // This querry builder is used to paginate the index
        $queryBuilder = $propertyRepository->createQueryBuilder('p');
        $queryBuilder->orderBy('p.id', 'ASC');
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            24
        );
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'pagination' => $pagination,
            'form' => $form,
        ]);
    }

    #[Route('/property/{id}', name: 'property_show')]
    public function property_show(PropertyRepository $propertyRepository, int $id): Response
    {
        $property = $propertyRepository->find($id);
        return $this->render('property/property.html.twig', [
            'property' => $property,
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
            $request->query->getInt('page', 1),
            24
        );
        return $this->render('home/property_display.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $propertyRepository,
            'pagination' => $pagination,
        ]);
    }

    #[Route('/simulator', name: 'simulator')]
    public function simulator(Request $request, ModelDVFService $model): Response
    {
        $form = $this->createForm(SimulatorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $model->loadSavedModel();
            $parameters['type_voie'] = $form->get('type_voie')->getData();
            $parameters['code_postal'] = $form->get('code_postal')->getData();
            $parameters['type_local'] = $form->get('type_local')->getData();
            $parameters['surface_reelle_bati'] = $form->get('surface_reelle_bati')->getData();
            $parameters['nb_pieces'] = $form->get('nb_pieces')->getData();
            $parameters['surface_terrain'] = $form->get('surface_terrain')->getData();
            return $this->redirectToRoute('simulator_result', [
                'parameters' => http_build_query($parameters),
            ]);
        }
        return $this->render('home/simulator.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/simulator_result/{parameters}', name: 'simulator_result')]
    public function simulator_result(string $parameters, ModelDVFService $model)
    {
        parse_str($parameters, $array);
        // dd($array);
        $model->loadSavedModel();
        
        return $this->render('simulator/simulator_result.html.twig', [
            // uses the model with the set of values given by the user to generated an IA estimated price
            'predict_value' =>  $model->predict([
                $array['type_voie'],
                $array['code_postal'],
                $array['type_local'],
                intval($array['surface_reelle_bati']),
                intval($array['nb_pieces']),
                intval($array['surface_terrain'])
            ]),
        ]);
    }
}
