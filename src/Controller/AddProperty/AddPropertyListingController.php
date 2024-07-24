<?php
namespace App\Controller\AddProperty;

use App\Entity\Listing;
use App\Entity\Property;
use App\Entity\PropertyFeatures;
use App\Entity\Image;
use App\Entity\User;
use App\Form\addProperty\addPropertySteps\Step1Type;
use App\Form\addProperty\addPropertySteps\Step2Type;
use App\Form\addProperty\addPropertySteps\Step3Type;
use App\Form\addProperty\addPropertySteps\Step4Type;
use App\Form\addProperty\addPropertySteps\Step5Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Service\ModelDVFService;

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
            $data = $form->getData();
            $data['Ville'] = 'Paris'; // Manually add the "Ville" key to the data
            $session->set('step1_data', $data);
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

        // Ensure step3Data is always an array
        if (!is_array($step3Data)) {
            $step3Data = [];
        }

        $form = $this->createForm(Step3Type::class, $step3Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Handle exception if something happens during file upload
                }

                $formData['img_url'] = 'uploads/property-images/'.$newFilename;
            }

            $session->set('step3_data', $formData);
            return $this->redirectToRoute('app_add_property_step4');
        }

        return $this->render('Property/addProperty/step3.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-property-listing/step/4', name: 'app_add_property_step4')]
    #[IsGranted('ROLE_USER')]
    public function step4(Request $request, SessionInterface $session, ModelDVFService $model): Response
    {
        $step4Data = $session->get('step4_data', []);
        $form = $this->createForm(Step4Type::class, $step4Data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('step4_data', $form->getData());
            return $this->redirectToRoute('app_add_property_summary');
        }

        $model->loadSavedModel();
        return $this->render('Property/addProperty/step4.html.twig', [
            'form' => $form->createView(),
            // uses the model with the set of values given by the user to generated an IA estimated price
                'predict_value' =>  $model->predict([
                    $session->get('step1_data')['type_voie'],
                    $session->get('step1_data')['code_postal'],
                    'Appartement',
                    $session->get('step1_data')['surface_reelle_bati'],
                    $session->get('step1_data')['type_voie'],
                    0
                ])
        ]);
    }

    #[Route('/add-property-listing/summary', name: 'app_add_property_summary')]
    #[IsGranted('ROLE_USER')]
    public function summary(Request $request, SessionInterface $session, UserRepository $userRepository): Response
    {
        $step1Data = $session->get('step1_data', []);
        $step2Data = $session->get('step2_data', []);
        $step3Data = $session->get('step3_data', []);
        $step4Data = $session->get('step4_data', []);
        

        //$form = $this->createForm(Step5Type::class);

        $form = $this->createFormBuilder()
            ->add('confirm', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            

            $listing = new Listing();
            $property = new Property();
            $propertyFeatures = new PropertyFeatures();
            $image = new Image();
            $user = new User();

            // Populate data from steps 1 to 4
            // Step 1
            $property->setNoVoie($step1Data['no_voie'] ?? null);
            $property->setTypeVoie($step1Data['type_voie'] ?? null);
            $property->setBTQ($step1Data['b_t_q'] ?? null);
            $property->setVoie($step1Data['voie'] ?? null);
            $property->setCodePostal($step1Data['code_postal'] ?? null);
            $property->setNbPieces($step1Data['nb_pieces'] ?? null);
            $property->setSurfaceReelleBati($step1Data['surface_reelle_bati'] ?? null);
            $property->setDateMutation((new \DateTime())->format('d-m-Y'));
            $property->setTypeLocal('Appartement');
            $property->setNatureMutation('Vente');
            $property->setCodeTypeLocal('2');

            // Step 2
            $propertyFeatures->setNumberOfBedrooms($step2Data['number_of_bedrooms'] ?? null);
            $propertyFeatures->setFloor($step2Data['floor'] ?? null);
            $propertyFeatures->setHeatingType($step2Data['heating_type'] ?? null);
            $propertyFeatures->setPropertyCondition($step2Data['property_condition'] ?? null);
            $propertyFeatures->setElevator($step2Data['elevator'] ?? false);
            $propertyFeatures->setBalcony($step2Data['balcony'] ?? false);
            $propertyFeatures->setParking($step2Data['parking'] ?? false);
            $propertyFeatures->setAirCondition($step2Data['air_condition'] ?? false);
            $propertyFeatures->setEnergyClass($step2Data['energy_class'] ?? null);
            $propertyFeatures->setTypeOfRooms($step1Data['nb_pieces'] ?? null);

            // Step 3
            $listing->setListingTitle($step3Data['listing_title']);
            $listing->setListingDescription($step3Data['listing_description']);
            $listing->setStatus('Inactive');
            $listing->setStartDate((new \DateTimeImmutable()));
            $listing->setEndDate((new \DateTimeImmutable())->modify('+3 months'));
            $image->setImgUrl($step3Data['img_url']);
            
            
            // Step 4
            $user = $userRepository->find($this->getUser());
            $property->setValeurFonciere($step4Data['valeur_fonciere'] ?? null);
            //phone nulber is stored without leading zero as table input is an integer not string
            $user->setPhoneNumber($step4Data['phone_number'] ?? null);

            // Step 5
            

            
          
            

            // Link entities
            $listing->setProperty($property);
            $property->setPropertyFeatures($propertyFeatures);
            $property->addImage($image);
            $property->setUser($user);

            $this->entityManager->persist($listing);
            $this->entityManager->persist($propertyFeatures);
            $this->entityManager->persist($property);
            $this->entityManager->persist($image);
            $this->entityManager->persist($user);
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