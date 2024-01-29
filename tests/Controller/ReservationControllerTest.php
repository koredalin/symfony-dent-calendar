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
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

/**
 * Description of ReservationControllerTest
 *
 * @author H1
 */
class ReservationControllerTest extends WebTestCase
{
    public function testAddOneWithPastDate()
    {
        $sessionFlashBag = $this->createMock(FlashBagInterface::class);
        $sessionFlashBag->method('add')->with('errorMessage', '');

        $session = $this->createMock(FlashBagAwareSessionInterface::class);
        $session->method('getFlashBag')
            ->willReturn($sessionFlashBag);

        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getMainRequest')
            ->willReturn(new Request());
        $requestStack->method('getSession')
            ->willReturn($session);

        $router = $this->createMock(RouterInterface::class);
        $router->method('generate')
               ->willReturn('/');

        $container = new Container();
        $container->set('router', $router);
        $container->set('request_stack', $requestStack);

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('warning');

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $translator = $this->createMock(TranslatorInterface::class);

        $controller = new ReservationController($requestStack, $logger, $entityManager, $translator);
        $controller->setContainer($container);

        $response = $controller->addOne(2024, 1, 2, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
