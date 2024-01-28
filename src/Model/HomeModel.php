<?php

namespace App\Model;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

/**
 * Description of HomeModel
 *
 * @author H1
 */
class HomeModel
{
    public function __construct(
        private ContainerBagInterface $params,
        private LoggerInterface $logger
    ) {}

    public function getValidatedCalendarInput(?int $year = null, ?int $month = null, string $monthChange = ''): array
    {
        if (is_null($year)) {
            $year = (int) date('Y');
        }

        if (is_null($month)) {
            $month = (int) date('m');
        }

        $errorMessage = '';
        $monthChanges = ['', 'last', 'next',];
        if (
            $year < (int) $this->params->get('start_year')
            || $year > (int) $this->params->get('end_year')
            || $month < 1
            || $month > 12
            || !in_array($monthChange, $monthChanges, true)
        ) {
            $year = (int) date('Y');
            $month = (int) date('m');
            $monthChange = '';
            $errorMessage = 'errors.wrong_month_param';
        }

        $monthName = date_create($year.'-'.$month.'-01')->format('M');
        if ($monthChange === 'last') {
            $datestring=$year.'-'.$month.'-01 first day of last month';
            $dt=date_create($datestring);
            $year = (int) $dt->format('Y');
            $month = (int) $dt->format('m');
            $monthName = $dt->format('M');
        }

        if ($monthChange === 'next') {
            $datestring=$year.'-'.$month.'-01 first day of next month';
            $dt=date_create($datestring);
            $year = (int) $dt->format('Y');
            $month = (int) $dt->format('m');
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
