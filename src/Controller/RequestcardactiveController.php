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

        $lastUsername = $authenticationUtils->getLastUsername();


        if(is_null($this->getUser()->getCard())) {
           // dd($cards->getCodeCentre());
        $flag=0;
            foreach ($cards as $key => $value) {

                if (($request->request->get('respcardactive')["keycenter"] == $value->getCodeCentre())
                    && ($request->request->get('respcardactive')["keycard"] == $value->getcodeCard())
                    && ($request->request->get('respcardactive')["checksum"] == $value->getChecksum())
                    && ($value->getStatus() == "attribué")) {

                    $value->setStatus("active");
                    $this->getUser()->setCard($value);

                    $em->persist($this->getUser());
                    $em->flush();
                    $this->addFlash('success', 'La carte est activée');
                    $flag=1;
                    break;

                }
            }
        if($flag==0) $this->addFlash('success', 'Code carte invalide');
        }
        else
        {

            $this->addFlash('success', 'Code carte invalide');



        }


        return $this->render('index/index.html.twig');  
    }


}
