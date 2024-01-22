<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Model\HomeModel;
use App\Model\ReservationModel;
use App\Helper\DateTimeHelper;

/**
 * Description of HomeController
 *
 * @author H1
 */
class HomeController extends AbstractController
{
    public function __construct(
        private HomeModel $home,
        private DateTimeHelper $dateTime
    ) {}

    #[Route('/{month<\d+>}/{year<\d+>}/{monthChange}', name: 'app_homepage', methods: ['GET'])]
    public function index(?int $year = null, ?int $month = null, string $monthChange = ''): Response
    {
        $validatedInput = $this->home->getValidatedCalendarInput($year , $month, $monthChange);
        $monthDays = $this->dateTime->getDaysInYearMonth($validatedInput['year'], $validatedInput['month']);
        $reservations = ReservationModel::RESERVATIONS;
        
        return $this->render('home/homepage.html.twig', [
            'title' => 'Dentist Calendar',
            'year' => $validatedInput['year'],
            'month' => $validatedInput['month'],
            'monthName' => $validatedInput['monthName'],
            'days' => $monthDays,
            'reservationHours' => HomeModel::RESERVATION_HOURS,
            'reservations' => $reservations,
            'errorMessage' => $validatedInput['errorMessage'],
        ]);
    }
}
