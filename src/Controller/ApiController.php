<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\HeaderUtils;
use App\Operation\UserPublishingHandler;
use App\Entity\User;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;


/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api")
 */
class ApiController extends AbstractController
{

   // private $userPublishingHandler;
    //public $cc;

   // public function __construct(UserPublishingHandler $userPublishingHandler)
    //{
     //   $this->productPublishingHandler = $userPublishingHandler;
    //}


    /**
     * @Route("/")
     */
    public function index()
    {
          $httpClient = HttpClient::create();

          $response = $httpClient->request('GET', 'http://localhost:8000/api');

          dd($response);


        return $this->redirect(
            'users'
        );
    }





}
