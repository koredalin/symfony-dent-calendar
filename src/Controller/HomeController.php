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
    protected const RESERVATIONS = [
        '01-2024' => [
            '12-01-2024' => [
                9 => ['id' => 22],
                12 => ['id' => 33],
                15 => ['id' => 43],
            ],
            '15-01-2024' => [
                11 => ['id' => 25],
                12 => ['id' => 37],
                16 => ['id' => 48],
            ],
        ],
        '02-2024' => [
            '13-01-2024' => [
                9 => ['id' => 122],
                12 => ['id' => 133],
                15 => ['id' => 143],
            ],
            '17-01-2024' => [
                11 => ['id' => 125],
                12 => ['id' => 137],
                16 => ['id' => 148],
            ],
        ],
    ];
    public function __construct(
        private HomeModel $home,
        private DateTimeHelper $dateTime
    ) {}

    #[Route('/{month<\d+>}/{year<\d+>}/{monthChange}', name: 'app_homepage', methods: ['GET'])]
    public function index(?int $year = null, ?int $month = null, string $monthChange = ''): Response
    {
        $validatedInput = $this->home->getValidatedCalendarInput($year , $month, $monthChange);
        
        return $this->render('home/homepage.html.twig', [
            'title' => 'Dentist Calendar',
            'year' => $validatedInput['year'],
            'month' => $validatedInput['month'],
            'monthName' => $validatedInput['monthName'],
            'days' => $this->dateTime->getDaysInYearMonth($year, $month),
            'hours' => HomeModel::HOURS,
            'errorMessage' => $validatedInput['errorMessage'],
        ]);
    }
}
