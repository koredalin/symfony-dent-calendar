<?php

namespace App\Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\HomeModel;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Psr\Log\LoggerInterface;

/**
 * Description of HomeModelTest
 *
 * @author H1
 */
class HomeModelTest extends TestCase
{
    public function testAddOneWithPastDate()
    {
        $paramsContainer = $this->createMock(ContainerBagInterface::class);
        $paramsContainer->expects($this->any())
            ->method('get')
            ->withConsecutive(
                ['start_year'],
                ['end_year']
              )
            ->willReturnOnConsecutiveCalls(2023, 2030);
        
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('warning')
            ->with($this->equalTo('errors.wrong_month_param'));

        $controller = new HomeModel($paramsContainer, $logger);

        // We expect the current year, month.
        $result = $controller->getValidatedCalendarInput(2020, 1, 2, 10);

        $currentMonthExpected = [
            'year' => (int) date('Y'),
            'month' => (int) date('m'),
            'monthName' => date_create(date('Y').'-'.date('m').'-01')->format('M'),
            'errorMessage' => 'errors.wrong_month_param',
        ];
        
        $this->assertEqualsCanonicalizing($currentMonthExpected, $result);
    }
}
