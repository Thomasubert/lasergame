<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegistrationController
 * @package App\Controller
 * @Route("registration")
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {


        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $password = $passwordEncoder->encodePassword(
                    $user,
                    $user->getPassword()
                );

                $user->setPassword($password);

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre compte est créé');

                return $this->redirectToRoute('app_index_index');

            } else {
                $this->addFlash(
                    'error',
                    'Le formulaire contient des erreurs'
                );
            }
        }

        return $this->render(
            'registration/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    public function accountInfo()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');
    }

    public function resetPassword()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }
}
