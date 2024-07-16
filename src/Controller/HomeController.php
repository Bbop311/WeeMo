<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use App\Service\propertyListGenerator;


class HomeController extends AbstractController
{
    #[Route('/home/{page}', name: 'app_home')]
    public function index(PropertyRepository $propertyRepository, propertyListGenerator $propertyListGenerator, int $page = 1): Response
    {
        $properties_list = $propertyListGenerator->getList($propertyRepository);
        $properties = [];
        for ($i = 24*($page-1)+1 ; $i < 24*($page)+1 ;$i++ )
        {
            $properties[] = $properties_list[$i];
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $properties,
            'page' => $page
        ]);
    }

    #[Route('/', name: 'home')]
    public function redirect_to_home(): Response
    {
        return $this->redirectToRoute('app_home');
    }
}
