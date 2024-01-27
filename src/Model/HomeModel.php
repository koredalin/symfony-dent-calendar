<?php

namespace App\Model;

use Psr\Log\LoggerInterface;

/**
 * Description of HomeModel
 *
 * @author H1
 */
class HomeModel
{
    public const RESERVATION_HOURS = [9, 10, 11, 12, 13, 14, 15, 16, 17,];
    protected const START_YEAR = 2023;
    protected const END_YEAR = 2030;

    public function __construct(
        private LoggerInterface $logger
    ) {}

    public function getValidatedCalendarInput(?int $year = null, ?int $month = null, string $monthChange = ''): array
    {
        $errorMessage = '';
        $monthChanges = ['last', 'next',];
        if (
            $year < self::START_YEAR
            || $year > self::END_YEAR
            || $month < 1
            || $month > 12
            || !in_array($monthChange, $monthChanges, true)
        ) {
            $year = date('Y');
            $month = date('m');
            $monthChange = '';
            $errorMessage = 'Wrong month parameters. Set to current month.';
        }

        $monthName = date_create($year.'-'.$month.'-01')->format('M');
        if ($monthChange === 'last') {
            $datestring=$year.'-'.$month.'-01 first day of last month';
            $dt=date_create($datestring);
            $year = $dt->format('Y');
            $month = $dt->format('m');
            $monthName = $dt->format('M');
        }

        if ($monthChange === 'next') {
            $datestring=$year.'-'.$month.'-01 first day of next month';
            $dt=date_create($datestring);
            $year = $dt->format('Y');
            $month = $dt->format('m');
            $monthName = $dt->format('M');
        }

        if (!empty($errorMessage)) {
            $this->logger->warning($errorMessage);
        }

        return [
            'year' => $year,
            'month' => $month,
            'monthName' => $monthName,
            'errorMessage' => $errorMessage,
        ];
    }
}
