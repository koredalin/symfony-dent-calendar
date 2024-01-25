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
    {
        $startAt = \DateTime::createFromFormat('Y-n-d H:i:s', $year.'-'.$month.'-'.$day.' '.$hour.':00:00');
//        $startAt = \DateTime::createFromFormat('Y-n-d H:i:s', $year.'-5-'.$day.' '.$hour.':00:00');
        // creates a task object and initializes some data for this example
        $formEntity = new ReservationForm();
        dump($startAt->format('Y-m-d H:i:s'));
        $date = new \DateTimeImmutable($startAt->format('Y-m-d'));
        dump($date);

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

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $this->entityManager->persist($userObj);

            // actually executes the queries (i.e. the INSERT query)
            $this->entityManager->flush();
            
            $reservationEntity = $this->entityManager->getRepository(Reservation::class)->findBy(['date' => $date]);
            if (isset($reservationEntity[0]) && $reservationEntity[0] instanceof Reservation) {
                $reservationObj = $reservationEntity[0];
            } else {
                $reservationObj = new Reservation();
                $reservationObj->setDate($date);
            }

            $userAtHour = (int) $startAt->format('H');
            $userAtMethod = Reservation::SET_USER_METHOD_NAME_BASE . $userAtHour;
            $reservationObj->$userAtMethod($userObj->getId());

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $this->entityManager->persist($reservationObj);

            // actually executes the queries (i.e. the INSERT query)
            $this->entityManager->flush();
            
dump($userObj);
            dump($reservationEntity);
dump($reservationInput);
//dd(5);
dd($reservationObj);

            return $this->redirectToRoute('app_reservation_add_one_success', ['reservation' => $userObj]);
        }

        return $this->render('reservation/add_one.html.twig', [
            'title'=>'Reserve an hour',
            'date'=>$startAt,
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
