<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;  

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    private $userPublishingHandler;
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->redirect(
            'users'
        );
    }
}
