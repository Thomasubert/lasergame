<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConnexionController
 * @package App\Controller
 * @Route("connexion ")
 */

class ConnexionController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('connexion/index.html.twig', [
            'controller_name' => 'ConnexionController',
        ]);
    }
}
