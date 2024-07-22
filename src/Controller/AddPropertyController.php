<?php
namespace App\Controller;

use App\Entity\Listing;
use App\Entity\Property;
use App\Entity\PropertyFeatures;
use App\Entity\Image;
use App\Form\addProperty\ListingStep1Type;
use App\Form\addProperty\ListingStep2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AddPropertyController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/add-property-listing', name: 'app_add_property_step1')]
    #[IsGranted('ROLE_USER')]
    public function step1(Request $request, SessionInterface $session): Response
    {
          //
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('account_create');
        }

        // $user = $this->getUser();
        // if (!$user || !in_array('ROLE_ADMIN', $user->getRoles())) {
        //     $this->addFlash('error', 'You must be logged in as an admin to access this page.');
        //     return $this->redirectToRoute('account_create');
        // }




        $step1Data = $session->get('step1_data', []);
        $form = $this->createForm(ListingStep1Type::class, $step1Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('step1_data', $form->getData());
            return $this->redirectToRoute('app_add_property_step2');
        }

        return $this->render('addProperty/step1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property/step2', name: 'app_add_property_step2')]
    #[IsGranted('ROLE_USER')]
    public function step2(Request $request, SessionInterface $session): Response
    {
        $step1Data = $session->get('step1_data', []);
        $step2Data = $session->get('step2_data', []);
        $form = $this->createForm(ListingStep2Type::class, $step2Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('step2_data', $form->getData());
            return $this->redirectToRoute('app_add_property_summary');
        }

        return $this->render('addProperty/step2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property/summary', name: 'app_add_property_summary')]
    #[IsGranted('ROLE_USER')]
    public function summary(Request $request, SessionInterface $session): Response
    {
        $step1Data = $session->get('step1_data', []);
        $step2Data = $session->get('step2_data', []);
        $form = $this->createFormBuilder()
            ->add('confirm', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listing = new Listing();
            $property = new Property();
            $propertyFeatures = new PropertyFeatures();
            $image = new Image();

            // Populate data from step 1
            $listing->setListingTitle($step1Data['listing_title']);
            $property->setDateMutation($step1Data['date_mutation']->format('Y-m-d'));
            $property->setNatureMutation($step1Data['nature_mutation']);

            // Populate data from step 2
            $propertyFeatures->setTypeOfRooms($step2Data['type_of_rooms']);
            $propertyFeatures->setNumberOfBedrooms($step2Data['number_of_bedrooms']);
            $propertyFeatures->setFloor($step2Data['floor']);
            $propertyFeatures->setPropertyCondition($step2Data['property_condition']);
            $propertyFeatures->setHeatingType($step2Data['heating_type']);
            $propertyFeatures->setEnergyClass($step2Data['energy_class']);
            $propertyFeatures->setElevator($step2Data['elevator']);
            $image->setImgUrl($step2Data['img_url']);

            // Link entities
            $listing->setProperty($property);
            $property->setPropertyFeatures($propertyFeatures);
            $property->addImage($image);

            // Associate the logged-in user
            $user = $this->getUser();
            $property->setUser($user);

            $this->entityManager->persist($listing);
            $this->entityManager->persist($propertyFeatures);
            $this->entityManager->persist($property);
            $this->entityManager->persist($image);
            $this->entityManager->flush();

            // Clear session data after successful submission
            $session->remove('step1_data');
            $session->remove('step2_data');

            return $this->redirectToRoute('app_add_property_success');
        }

        return $this->render('addProperty/summary.html.twig', [
            'step1_data' => $step1Data,
            'step2_data' => $step2Data,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property/success', name: 'app_add_property_success')]
    #[IsGranted('ROLE_USER')]
    public function success(): Response
    {
        return $this->render('addProperty/listing_success.html.twig');
    }
}
