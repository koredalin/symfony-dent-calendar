<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use App\Model\ReservationModel;

class ReservationController extends AbstractController
{
    protected const IDS = [3,];
    
    public function __construct(
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager
    ) {}


    #[Route('/reservations/add')]
    public function add(): Response
    {
        return new Response('Title: "User Add."');
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
