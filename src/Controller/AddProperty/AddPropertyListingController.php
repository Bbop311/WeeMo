<?php
namespace App\Controller\AddProperty;

use App\Entity\Listing;
use App\Entity\Property;
use App\Entity\PropertyFeatures;
use App\Entity\Image;
use App\Form\addProperty\addPropertySteps\Step1Type;
use App\Form\addProperty\addPropertySteps\Step2Type;
use App\Form\addProperty\addPropertySteps\Step3Type;
use App\Form\addProperty\addPropertySteps\Step4Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AddPropertyListingController extends AbstractController
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
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('account_create');
        }

        $step1Data = $session->get('step1_data', []);
        $form = $this->createForm(Step1Type::class, $step1Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('step1_data', $form->getData());
            return $this->redirectToRoute('app_add_property_step2');
        }

        return $this->render('Property/addProperty/step1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property-listing/step/2', name: 'app_add_property_step2')]
    #[IsGranted('ROLE_USER')]
    public function step2(Request $request, SessionInterface $session): Response
    {
        $step2Data = $session->get('step2_data', []);
        $form = $this->createForm(Step2Type::class, $step2Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('step2_data', $form->getData());
            return $this->redirectToRoute('app_add_property_step3');
        }

        return $this->render('Property/addProperty/step2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property-listing/step/3', name: 'app_add_property_step3')]
    #[IsGranted('ROLE_USER')]
    public function step3(Request $request, SessionInterface $session): Response
    {
        $step3Data = $session->get('step3_data', []);
        $form = $this->createForm(Step3Type::class, $step3Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('step3_data', $form->getData());
            return $this->redirectToRoute('app_add_property_step4');
        }

        return $this->render('Property/addProperty/step3.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property-listing/step/4', name: 'app_add_property_step4')]
    #[IsGranted('ROLE_USER')]
    public function step4(Request $request, SessionInterface $session): Response
    {
        $step4Data = $session->get('step4_data', []);
        $form = $this->createForm(Step4Type::class, $step4Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('step4_data', $form->getData());
            return $this->redirectToRoute('app_add_property_summary');
        }

        return $this->render('Property/addProperty/step4.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property-listing/summary', name: 'app_add_property_summary')]
    #[IsGranted('ROLE_USER')]
    public function summary(Request $request, SessionInterface $session): Response
    {
        $step1Data = $session->get('step1_data', []);
        $step2Data = $session->get('step2_data', []);
        $step3Data = $session->get('step3_data', []);
        $step4Data = $session->get('step4_data', []);

        $form = $this->createFormBuilder()
            ->add('confirm', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listing = new Listing();
            $property = new Property();
            $propertyFeatures = new PropertyFeatures();
            $image = new Image();

            // Populate data from steps 1 to 4
            $listing->setListingTitle($step1Data['listing_title']);
            $property->setDateMutation($step2Data['date_mutation']->format('Y-m-d'));
            $property->setNatureMutation($step3Data['nature_mutation']);
            $propertyFeatures->setTypeOfRooms($step1Data['type_of_rooms']);
            $propertyFeatures->setNumberOfBedrooms($step2Data['number_of_bedrooms']);
            $propertyFeatures->setFloor($step3Data['floor']);
            $propertyFeatures->setPropertyCondition($step3Data['property_condition']);
            $propertyFeatures->setHeatingType($step4Data['heating_type']);
            $propertyFeatures->setEnergyClass($step4Data['energy_class']);
            $propertyFeatures->setElevator($step1Data['elevator']);
            $image->setImgUrl($step4Data['img_url']);

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
            $session->remove('step3_data');
            $session->remove('step4_data');

            return $this->redirectToRoute('app_add_property_success');
        }

        return $this->render('Property/addProperty/summary.html.twig', [
            'step1_data' => $step1Data,
            'step2_data' => $step2Data,
            'step3_data' => $step3Data,
            'step4_data' => $step4Data,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property/success', name: 'app_add_property_success')]
    #[IsGranted('ROLE_USER')]
    public function success(): Response
    {
        return $this->render('Property/addProperty/listing_success.html.twig');
    }
}
