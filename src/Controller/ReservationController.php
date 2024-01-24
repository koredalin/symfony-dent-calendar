<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ReservationForm;
use App\Form\Type\ReservationType;
use App\Entity\Reservation;
use App\Entity\User;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use App\Model\ReservationModel;

class ReservationController extends AbstractController
{
    protected const IDS = [3,];
    
    private Request $request;
    
    public function __construct(
        RequestStack $requestStack,
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager
    ) {
        $this->request = $requestStack->getMainRequest();
    }


    #[Route('/reservation/add_one/{year<\d+>}/{month<\d+>}/{day<\d+>}/{hour<\d+>}', name: 'app_reservation_add_one')]
    public function addOne(int $year, int $month, int $day, int $hour): Response
//    public function new(Request $request)
    {
//        dd(__LINE__);
//        $year = 2024;
//        $month = 01;
//        $day = 13;
//        $hour = 14;
        $date = \DateTime::createFromFormat('Y-n-d H:i:s', $year.'-'.$month.'-'.$day.' '.$hour.':00:00');
        // creates a task object and initializes some data for this example
        $formEntity = new ReservationForm();
//        $formEntity->setName('Full Name.');
//        $formEntity->setEmail('Email.');
//        $formEntity->setPhone('Phone Number.');
        dump($date->format('Y-m-d H:i:s'));
        $startAt = new \DateTimeImmutable($date->format('Y-m-d H:i:s'));
        dump($startAt);
        $formEntity->setStartAt($startAt);

        $form = $this->createForm(ReservationType::class, $formEntity);

        $form->handleRequest($this->request);
        if ($form->isSubmitted() && $form->isValid()) {
//            dd(__LINE__);
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $reservationInput = $form->getData();
            // ... perform some action, such as saving the task to the database
            $userObj = new User();
            $userObj->setName($reservationInput->getName());
            $userObj->setEmail($reservationInput->getEmail());
            $userObj->setPhone($reservationInput->getPhone());
            $userObj->setCreatedAt(new \DateTime());
            $userObj->setUpdatedAt(new \DateTime());

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $this->entityManager->persist($userObj);

            // actually executes the queries (i.e. the INSERT query)
            $this->entityManager->flush();
dump($reservationInput);
dump($userObj);
$startAtHour = (int) $date->format('H');
$startAtMethod = 'setStartAt' . $startAtHour;
            $reservationObj = new Reservation();
            $reservationObj->setDate($startAt);
            $reservationObj->$startAtMethod($userObj->getId());
            $reservationObj->setCreatedAt(new \DateTime());
            $reservationObj->setUpdatedAt(new \DateTime());

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $this->entityManager->persist($reservationObj);

            // actually executes the queries (i.e. the INSERT query)
            $this->entityManager->flush();
            
dd($reservationObj);

            return $this->redirectToRoute('app_reservation_add_one_success', ['reservation' => $userObj]);
        }

        return $this->render('reservation/add_one.html.twig', [
            'title'=>'Reserve an hour',
            'date'=>$date,
            'form'=>$form,
        ]);
    }

    #[Route('/reservation/add_one_success/{id<\d+>}', name: 'app_reservation_add_one_success')]
    public function addOneSuccess(Reservation $reservation): Response
    {
        
    }

    #[Route('/api/reservation/{id<\d+>}', methods: ['GET'], name: 'api_reservation_get_one')]
    public function getOne(int $id): Response
    {
        // TODO if no found record.
        if (!in_array($id, self::IDS)) {
            $this->logger->warning('Reserved reservation not found. Id: {reservation}.', [
                'reservation' => $id,
            ]);
            
            return $this->json(json_encode([]));
        }

        // TODO query the database
        $song = [
            'id' => $id,
            'patient_name' => 'Ivan Ivanov',
            'patient_email' => 'i.ivanov@gmail.com',
            'patient_phone' => '+359889777111',
            'reservation_hour' => 9,
            'date' => '12-01-2024',
        ];

        return $this->json($song);
    }
}
