<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Card;
use App\Form\UserType;
use App\Repository\CardRepository;
use App\Repository\UserRepository;
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
     * @param EntityManagerInterface $em
     * return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/requestcardadmin",)
     *
     */
    public function index(EntityManagerInterface $em,CardRepository $cardRepository, $id)
    {

        $this->addFlash('success', 'User sans carte');

        $cards = $cardRepository->findAll();

        return $this->render('card/index.html.twig', [
            'cards' => $cards
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/requestcardadmin/{id}",defaults={"id": null}, requirements={"id": "\d+"}, name="requestcardadmin")
     *
     */
    public function requestcardadmin(EntityManagerInterface $em,CardRepository $cardRepository,UserRepository $userRepository, $id)
    {
        $users = $userRepository->findAll();
        $cards = $cardRepository->findAll();
        $result = $em->find(User::class, $id);



        if($checkCardFree=$cardRepository->findFreeCard()==false)
        {
            $this->addFlash('success', 'Les cartes sont indisponible en stock, le joueur est enregistré');

            return $this->render('admin/index.html.twig', [
                'users' => $users
            ]);

        }

        foreach ($cards as $key => $value) {

            if ($value->getStatus() == "libre") {
                  $value->setStatus("attribué");
                  $result->setCard($value);
                  $em->persist($result);
                  $em->flush();
                  break;
            }

        }

        $this->addFlash('success', 'La carte est attribué');
        return $this->render('admin/index.html.twig', [
            'users' => $users
        ]);



    }



}

