<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class ConnexionController
 * @package App\Controller
 * @Route("/")
 */

class ConnexionController extends AbstractController
{

    /**
     * @Route("/déconnexion")
     */

    public function logout()
    {

    }



}
