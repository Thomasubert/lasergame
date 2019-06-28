<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ContactController
 * @package App\Controller
 * @Route("contact")
 */

class ContactController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
