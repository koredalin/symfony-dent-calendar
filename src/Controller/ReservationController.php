<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ReservationForm;
use App\Form\Type\ReservationType;
use App\Entity\Reservation;
use App\Entity\User;

class ReservationController extends AbstractController
{
    private Request $request;
    
    public function __construct(
        RequestStack $requestStack,
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager,
        private TranslatorInterface $translator
    ) {
        $this->request = $requestStack->getMainRequest();
    }


    #[Route('/reservation/add_one/{year<\d+>}/{month<\d+>}/{day<\d+>}/{hour<\d+>}', name: 'app_reservation_add_one')]
    public function addOne(int $year, int $month, int $day, int $hour): Response
    {
        $beginAt = \DateTime::createFromFormat('Y-n-d H:i:s', $year.'-'.$month.'-'.$day.' '.$hour.':00:00');
        $now = new \DateTime();
        if ($beginAt < $now) {
            $errorMessage = $this->translator->trans('errors.previous_period_reservation');
            $this->logger->warning($errorMessage);
            $this->addFlash('errorMessage', $errorMessage);

            return $this->redirectToRoute('app_homepage');
        }

        $beginAtStr = $beginAt->format('Y-m-d H:i:s');
        // creates a task object and initializes some data for this example
        $formEntity = new ReservationForm();
        $date = new \DateTimeImmutable($beginAt->format('Y-m-d'));

        $form = $this->createForm(ReservationType::class, $formEntity);

        $form->handleRequest($this->request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservationInput = $form->getData();

            $userObj = new User();
            $userObj->setName($reservationInput->getName());
            $userObj->setEmail($reservationInput->getEmail());
            $userObj->setPhone($reservationInput->getPhone());

            $this->entityManager->persist($userObj);
            $this->entityManager->flush();
            
            $reservationEntity = $this->entityManager->getRepository(Reservation::class)->findBy(['date' => $date]);
            if (isset($reservationEntity[0]) && $reservationEntity[0] instanceof Reservation) {
                $reservationObj = $reservationEntity[0];
            } else {
                $reservationObj = new Reservation();
                $reservationObj->setDate($date);
            }

            $userAtHour = (int) $beginAt->format('H');
            $userAtMethod = Reservation::SET_USER_METHOD_BASE_STR . $userAtHour;
            $reservationObj->$userAtMethod($userObj);

            $this->entityManager->persist($reservationObj);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_reservation_add_one_success', ['userId' => $userObj->getId(), 'beginAt' => $beginAtStr]);
        }

        return $this->render('reservation/add_one.html.twig', [
            'title'=>'Reserve an hour',
            'date'=>$beginAt,
            'form'=>$form,
        ]);
    }

    #[Route('/reservation/add_one_success/{userId<\d+>}/{beginAt}', name: 'app_reservation_add_one_success')]
    public function addOneSuccess(int $userId, string $beginAt): Response
    {
        $userEntity = $this->entityManager->getRepository(User::class)->find($userId);
        
        return $this->render('reservation/add_one_success.html.twig', [
            'title' => $this->translator->trans('reservation.reserved'),
            'user' => $userEntity,
            'date' => $beginAt,
        ]);
    }
}
