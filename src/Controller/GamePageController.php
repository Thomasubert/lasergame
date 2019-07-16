<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class gamePageController
 * @package App\Controller
 * @Route("gamePage")
 */
class GamePageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('game.html.twig', [
            'controller_name' => 'gamePAgeController',
        ]);
    }
}



