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
     * @Route("login")
     * @param AuthenticationUtils $utils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        if (!empty($error)){
            $this->addFlash('error', 'Identifiants incorrects');
        }




        return $this->render('connexion/index.html.twig', [
            'last_username' => $lastUsername
        ]);
    }
    
    /**
     * @Route("/déconnexion")
     */

    public function logout()
    {

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
