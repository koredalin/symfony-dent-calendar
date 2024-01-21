<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Model\HomeModel;
use App\Helper\DateTimeHelper;

/**
 * Description of HomeController
 *
 * @author H1
 */
class HomeController extends AbstractController
{
    protected const HOURS = [9, 10, 11, 12, 13, 14, 15, 16, 17,];
    
    public function __construct(
        private HomeModel $home,
        private DateTimeHelper $dateTime
    ) {}

    #[Route('/{month<\d+>}/{year<\d+>}/{monthChange}', name: 'app_homepage', methods: ['GET'])]
    public function index(?int $year = null, ?int $month = null, string $monthChange = ''): Response
    {
//        $errorMessage = '';
//        $monthChanges = ['last', 'next',];
//        if (
//            $year < self::START_YEAR
//            || $year > self::END_YEAR
//            || $month < 1
//            || $month > 12
//            || !in_array($monthChange, $monthChanges, true)
//        ) {
//            $year = date('Y');
//            $month = date('m');
//            $monthChange = '';
//            $errorMessage = 'Wrong month parameters. Set to current month.';
//        }
//
//        $monthName = date_create($year.'-'.$month.'-01')->format('M');
//        if ($monthChange === 'last') {
//            $datestring=$year.'-'.$month.'-01 first day of last month';
//            $dt=date_create($datestring);
//            $year = $dt->format('Y');
//            $month = $dt->format('m');
//            $monthName = $dt->format('M');
//        }
//
//        if ($monthChange === 'next') {
//            $datestring=$year.'-'.$month.'-01 first day of next month';
//            $dt=date_create($datestring);
//            $year = $dt->format('Y');
//            $month = $dt->format('m');
//            $monthName = $dt->format('M');
//        }
        
        $validatedInput = $this->home->getValidatedCalendarInput($year , $month, $monthChange);
        
        return $this->render('home/homepage.html.twig', [
            'title' => 'Dentist Calendar',
            'year' => $validatedInput['year'],
            'month' => $validatedInput['month'],
            'monthName' => $validatedInput['monthName'],
            'days' => $this->dateTime->getDaysInYearMonth($year, $month),
            'hours' => self::HOURS,
            'errorMessage' => $validatedInput['errorMessage'],
        ]);
    }
}
