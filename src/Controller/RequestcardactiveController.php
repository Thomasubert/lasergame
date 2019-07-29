<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Card;
use App\Form\UserType;
use App\Repository\CardRepository;
use App\Service\AssignedUserCard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\RespcardactiveType;

class RequestcardactiveController extends AbstractController
{
    /**
     * @Route("/requestcardactive", name="requestcardactive")
     */
    public function index(AuthenticationUtils $authenticationUtils,EntityManagerInterface $em,CardRepository $cardRepository)
    {

        $form=$this->createForm(RespcardactiveType::class);

        return $this->render('card/requestcardactive.html.twig', [
            'form'=>$form->createView()

        ]);
    }

    /**
     * @Route("/responsecardactive", name="responsecardactive")
     */
    public function responseActivecard(Request $request,AuthenticationUtils $authenticationUtils,EntityManagerInterface $em,CardRepository $cardRepository)
    {

        $cards=$cardRepository->findAll();


        if($this->getUser()->getCard()->getStatus()=="attribué")
        {
            if (($request->request->get('respcardactive')["keycenter"] == $this->getUser()->getCard()->getCodeCentre())
                && ($request->request->get('respcardactive')["keycard"] == $this->getUser()->getCard()->getcodeCard())
                && ($request->request->get('respcardactive')["checksum"] == $this->getUser()->getCard()->getChecksum()))
            {
                $this->getUser()->getCard()->setStatus("active");
                //dd($this->getUser()->getCard()->getStatus("active"));
                $em->persist($this->getUser());
                $em->flush();
                $this->addFlash('success', 'La carte est activée');

            }
        }
        else {
            $this->addFlash('success', 'Code carte invalide');
        }
        return $this->render('index/index.html.twig');  
    }
}
