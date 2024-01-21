<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

/**
 * Description of HomeController
 *
 * @author H1
 */
class HomeController extends AbstractController
{
    protected const HOURS = [9, 10, 11, 12, 13, 14, 15, 16, 17,];
    protected const SKIP_WEEK_DAYS = ['Sat', 'Sun',];
    protected const START_YEAR = 2023;
    protected const END_YEAR = 2030;

    #[Route('/')]
    public function homepage(?int $year = null, ?int $month = null, string $month_change = ''): Response
    {
        $monthChanges = ['last', 'next',];
        var_dump($year);
        if (
            $year < self::START_YEAR
//            || $year > self::END_YEAR
//            || $month < 1
//            || $month > 12
//            || !in_array($month_change, $monthChanges, true)
        ) {
            var_dump(__LINE__);
            $year = date('Y');
            $month = date('m');
            $month_change = '';
        }

        $monthName = date_create($year.'-'.$month.'-01')->format('M');
        if ($month_change === 'last') {
            $datestring=$year.'-'.$month.'-01 first day of last month';
            $dt=date_create($datestring);
            $year = $dt->format('Y'); //2011-02
            $month = $dt->format('m'); //2011-02
            $monthName = $dt->format('M');
        }

        if ($month_change === 'next') {
            $datestring=$year.'-'.$month.'-01 first day of next month';
            $dt=date_create($datestring);
            $year = $dt->format('Y'); //2011-02
            $month = $dt->format('m'); //2011-02
            $monthName = $dt->format('M');
        }
        var_dump($month);
        var_dump($monthName);
        var_dump($year);
        
        return $this->render('home/homepage.html.twig', [
            'title' => 'Dentist Calendar',
            'year' => $year,
            'month' => $month,
            'monthName' => $monthName,
            'days' => $this->getDaysInYearMonth(2024, 2),
            'hours' => self::HOURS,
        ]);
    }
    
    // TODO - Move to model or helper.
    function getDaysInYearMonth (int $year, int $month){
        $date = DateTime::createFromFormat("Y-n", "$year-$month");

          $datesArray = array();
          for($i=1; $i<=$date->format("t"); $i++){
              $dateFormat = [];
              $dateFormat['week_day'] = DateTime::createFromFormat("Y-n-d", "$year-$month-$i")->format('D');
              if (in_array($dateFormat['week_day'], self::SKIP_WEEK_DAYS, true)) {
                  continue;
              }

              $dateFormat['year'] = DateTime::createFromFormat("Y-n-d", "$year-$month-$i")->format('Y');
              $dateFormat['month'] = DateTime::createFromFormat("Y-n-d", "$year-$month-$i")->format('m');
              $dateFormat['day'] = DateTime::createFromFormat("Y-n-d", "$year-$month-$i")->format('d');
              $datesArray[] = $dateFormat;
          }

        return $datesArray;
    }
}
