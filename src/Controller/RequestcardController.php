<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Card;
use App\Form\UserType;
use App\Repository\CardRepository;
use App\Service\AssignedUserCard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RequestcardController extends AbstractController
{
    /**
     * @Route("/requestcard", name="requestcard")
     */
    public function index(AuthenticationUtils $authenticationUtils,EntityManagerInterface $em,CardRepository $cardRepository)
    {

        //  $objAssign->AssignedDirection($cardRepository,$user);

            $cards=$cardRepository->findAll();

            $lastUsername = $authenticationUtils->getLastUsername();

           // dd($this->getUser()->getCard()->getStatus());


         if($this->getUser()->getCard()==null)
         {
             foreach ($cards as $key => $value) {

                 //dd($this->getUser()->getCard()!=null);
                 if ($value->getStatus() == "libre") {
                     $value->setStatus("attribué");
                     $this->getUser()->setCard($value);
                     break;
                 }

             }
             $em->persist($this->getUser());
             $em->flush();

             $this->addFlash('success', 'La demande de la carte a été énregistrée');

             return $this->redirectToRoute('redirectRequesttouserhome');

         }

         elseif($this->getUser()->getCard()->getStatus()=="attribué")
            {

                $this->addFlash('success', 'Vous avez déjà une demande de carte en attente');

                return $this->redirectToRoute('redirectRequesttouserhome');

            }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/redirectRequesttouserhome", name="redirectRequesttouserhome")
     */
    public function redirectRequesttouserhome()
    {

        return $this->render('index/index.html.twig');  
    }
}

