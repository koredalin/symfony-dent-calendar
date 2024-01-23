<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

/**
 * Description of HomeController
 *
 * @author H1
 */
class UserController extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager
    ) {}


    #[Route('/user/add')]
    public function add(): Response
    {
        $product = new User();
        $product->setName('Stoyan Stoyanov');
        $product->setEmail('s.stoyanov4@yahoo.com');
        $product->setPhone('+359889222004');
        $product->setCreatedAt(new \DateTime());
        $product->setUpdatedAt(new \DateTime());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        return new Response('Title: "User Add."');
    }

    #[Route('/user/{id<\d+>}', name: 'user_show')]
    public function show(int $id): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            $this->logger->warning('No product found for id '.$id.'.');
        }

        return new Response('Check out this great product: '.$user->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
