<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\HeaderUtils;
use App\Operation\UserPublishingHandler;
use App\Entity\User;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api")
 */
class ApiController extends AbstractController
{

    private $userPublishingHandler;
    public $cc;

    public function __construct(UserPublishingHandler $userPublishingHandler)
    {
        $this->productPublishingHandler = $userPublishingHandler;
    }


    /**
     * @Route("/")
     */
    public function index()
    {

        return $this->redirect(
            'users'
        );
    }


    

    public function __invoke(User $data): User
    {
        //
        //  ici, on fait ce que l'on veut avec les données
        //  il est recommandé de faire appel à un handler pour traiter les donnés comme on veut
        $this->cc=$this->userPublishingHandler->handle($data);
        //
        //

        return $data;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/users",name="users")
     */
    public function users()
    {
      dd( $this->cc);

        return $this->render('api/index.html.twig');

    }


}
