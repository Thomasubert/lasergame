<?php

namespace App\Controller\Admin;

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
     * @param EntityManagerInterface $em
     * return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/requestcardactiveadmin/{id}",defaults={"id": null}, requirements={"id": "\d+"}, name="requestcardactiveadmin")
     */
    public function index(AuthenticationUtils $authenticationUtils,EntityManagerInterface $em,CardRepository $cardRepository, $id)
    {
          $result = $em->find(Card::class, $id);
          //dd($result->getId());
          $result->setStatus("active");
          $em->persist($result);
          $em->flush();
          $this->addFlash('success', 'La carte est activée');

        $cards = $cardRepository->findAll();

        return $this->render('card/index.html.twig', [
            'cards' => $cards
        ]);
    }
//@param EntityManagerInterface $em
// @param Card $card
//@return \Symfony\Component\HttpFoundation\RedirectResponse

    public function delete(EntityManagerInterface $em, Card $card)
    {
        $em->remove($card);
        $em->flush();
        $this->addFlash(
            'success',
            'La carte est bien désactivée'
        );

        return $this->redirectToRoute(
            'app_admin_card_index'
        );

    }

    /**
     * @Route("/responsecardactiveadmin", name="responsecardactiveadmin")
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
