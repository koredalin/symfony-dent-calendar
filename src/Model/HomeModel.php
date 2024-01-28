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
        $errorMessage = '';
        $monthChanges = ['last', 'next',];
        if (
            $year < $this->params->get('start_year')
            || $year > $this->params->get('end_year')
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
