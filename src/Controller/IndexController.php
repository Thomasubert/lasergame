<?php

namespace App\Controller;

use App\Form\SearchUserType;
use App\Repository\UserRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;



class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('home/home.html.twig');
    }
/*
    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search")
     */
    /*public function search(Request $request, UserRepository $userRepository)
    {
        $searchForm = $this->createForm(SearchUserType::class);
        $searchForm->handleRequest($request);

        dump($searchForm->getData());

        $users = $userRepository->search((array)$searchForm->getData());

       return $this->render('index/search.html.twig',[
           'users' => $users,
           'search_form' => $searchForm->createView()
       ]);


    }*/
}
