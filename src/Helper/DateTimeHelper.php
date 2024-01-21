<?php

namespace App\Helper;

use DateTime;

/**
 * Description of DateTimeHelper
 *
 * @author H1
 */
class DateTimeHelper
{
    protected const SKIP_WEEK_DAYS = ['Sat', 'Sun',];

    public function getDaysInYearMonth(int $year, int $month): array
    {
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
