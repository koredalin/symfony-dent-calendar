<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of HomeController
 *
 * @author H1
 */
class UserController
{
    #[Route('/user/add')]
    public function add(): Response
    {
        return new Response('Title: "User Add."');
    }
}
