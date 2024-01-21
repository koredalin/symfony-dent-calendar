<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of HomeController
 *
 * @author H1
 */
class HomeController
{
    #[Route('/')]
    public function homepage(): Response
    {
        return new Response('Title: "PB and Jams"');
    }
}
