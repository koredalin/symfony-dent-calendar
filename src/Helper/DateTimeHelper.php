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
    public function __construct(
        private array $nonWorkingWeekDays
    ) {}
    
    public function getDaysInYearMonth(?int $year, ?int $month): array
    {
        if (empty($year) || empty($month)) {
            $year = date('Y');
            $month = date('n');
        }

        $date = DateTime::createFromFormat("Y-n", "$year-$month");

        $datesArray = array();
        for($i=1; $i<=$date->format("t"); $i++){
            $weekDay = DateTime::createFromFormat("Y-n-d", "$year-$month-$i")->format('D');
            if (in_array($weekDay, $this->nonWorkingWeekDays, true)) {
                continue;
            }

            $datesArray[] = DateTime::createFromFormat("Y-m-d", "$year-$month-$i");
        }

        return $datesArray;
    }
}
