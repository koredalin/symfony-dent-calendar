<?php

namespace App\Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\HomeModel;
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
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('warning')
            ->with($this->equalTo('Wrong month parameters. Set to current month.'));

        $controller = new HomeModel($logger);

        // We expect the current year, month.
        $result = $controller->getValidatedCalendarInput(2020, 1, 2, 10);

        $currentMonthExpected = [
            'year' => date('Y'),
            'month' => date('m'),
            'monthName' => date_create(date('Y').'-'.date('m').'-01')->format('M'),
            'errorMessage' => 'Wrong month parameters. Set to current month.',
        ];
        
        $this->assertEqualsCanonicalizing($currentMonthExpected, $result);
    }
}
