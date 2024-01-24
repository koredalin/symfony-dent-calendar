<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ReservationForm;
use App\Form\Type\ReservationType;
//use App\Model\ReservationModel;

class ReservationController extends AbstractController
{
    protected const IDS = [3,];
    
    public function __construct(
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager
    ) {}


//    #[Route('/reservation/add_one/{year<\d+>}/{month<\d+>}/{day<\d+>}/{hour<\d+>}', name: 'app_reservation_add_one')]
//    public function addOne(int $year, int $month, int $day, int $hour): Response
    public function new(Request $request)
    {
        $year = 2024;
        $month = 01;
        $day = 13;
        $hour = 14;
        $date = \DateTime::createFromFormat('Y-n-d H:i:s', $year.'-'.$month.'-'.$day.' '.$hour.':00:00');
        // creates a task object and initializes some data for this example
        $formEntity = new ReservationForm();
        $formEntity->setName('Full Name.');
        $formEntity->setEmail('Email.');
        $formEntity->setPhone('Phone Number.');

        $form = $this->createForm(ReservationType::class, $formEntity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $reservationInput = $form->getData();
dd($reservationInput);
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('task_success');
        }

        return $this->render('reservation/add_one.html.twig', [
            'title'=>'Reserve an hour',
            'date'=>$date,
            'form'=>$form,
        ]);
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
