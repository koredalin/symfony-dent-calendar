<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Model\HomeModel;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reservation;
use App\Helper\DateTimeHelper;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Description of HomeController
 *
 * @author H1
 */
class HomeController extends AbstractController
{
    public function __construct(
        private HomeModel $home,
        private DateTimeHelper $dateTime,
        private EntityManagerInterface $entityManager,
        private TranslatorInterface $translator
    ) {}

    #[Route('/{month<\d+>}/{year<\d+>}/{monthChange}', name: 'app_homepage', methods: ['GET'])]
    public function index(?int $year = null, ?int $month = null, string $monthChange = ''): Response
    {
        $validatedInput = $this->home->getValidatedCalendarInput($year , $month, $monthChange);
        $monthDays = $this->dateTime->getDaysInYearMonth($validatedInput['year'], $validatedInput['month']);
        
        return $this->render('home/homepage.html.twig', [
            'title' => $this->translator->trans('home.title'),
            'year' => $validatedInput['year'],
            'month' => $validatedInput['month'],
            'monthName' => $validatedInput['monthName'],
            'days' => $monthDays,
            'reservationHours' => HomeModel::RESERVATION_HOURS,
            'reservations' => $this->getMonthlyReservationHours($validatedInput['year'], $validatedInput['month']),
            'now' => (new \DateTime())->format('Y-m-d H:i:s'),
            'errorMessage' => $validatedInput['errorMessage'],
        ]);
    }

    private function getMonthlyReservationHours(int $year, int $month): array
    {
        $reservations = $this->entityManager->getRepository(Reservation::class)->findByMonth($year, $month);
        $result = [];
        foreach ($reservations as $reservation) {
            $reservationHours = [];
            foreach (HomeModel::RESERVATION_HOURS as $hour) {
                $getUserAtMethodName = Reservation::GET_USER_METHOD_BASE_STR.$hour;
                if (method_exists($reservation, $getUserAtMethodName) && $reservation->{$getUserAtMethodName}() !== null) {
                    $userAtObj = $reservation->{$getUserAtMethodName}();
                    $reservationHours[] = [
                        'userAtId' => $userAtObj->getId(),
                        'userAtName' => $userAtObj->getName(),
                        'userAtEmail' => $userAtObj->getEmail(),
                        'userAtPhone' => $userAtObj->getPhone(),
                        'hour' => $hour,
                    ];
                }
            }
            
            $reservationDate = $reservation->getDate()->format('Y-m-d');
            $result[$reservationDate] = $reservationHours;
        }
        
        return $result;
    }
}
