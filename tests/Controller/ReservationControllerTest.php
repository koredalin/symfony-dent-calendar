<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\ReservationController;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\RouterInterface;

/**
 * Description of ReservationControllerTest
 *
 * @author H1
 */
class ReservationControllerTest extends WebTestCase
{
    public function testAddOneWithPastDate()
    {
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getMainRequest')
            ->willReturn(new Request());

        $router = $this->createMock(RouterInterface::class);
        $router->method('generate')
               ->willReturn('/');

        $container = new Container();
        $container->set('router', $router);
        

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('warning')
            ->with($this->equalTo('A reservation for previous period.'));

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $translator = $this->createMock(TranslatorInterface::class);

        $controller = new ReservationController($requestStack, $logger, $entityManager, $translator);
        $controller->setContainer($container);

        $response = $controller->addOne(2024, 1, 2, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
