<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class UserController
 * @package App\Controller
 * @Route("user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, EntityManagerInterface $em, UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }


    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $id
     */
    public function edit (Request $request, EntityManagerInterface $em, $id)
    {
        if (is_null($id)){
            $user = new User();
        } else {
            $user = $em->find(User::class, $id);

            if (is_null($user)){
                throw new NotFoundHttpException();
            }
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        dump($user);

        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Le joueur est enregistré');

                return $this->redirectToRoute('app_user_index');
            }else{
                $this->addFlash('error', 'Le formulaire contient des erreurs')
            }
        }
        return $this->render('/user/edit.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    
}
