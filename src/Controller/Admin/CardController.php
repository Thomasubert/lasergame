<?php

namespace App\Controller\Admin;

use App\Service\CardGenerator;
use App\Entity\Card;
use App\Entity\User;
use App\Form\CardType;
use App\Repository\CardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CardController
 * @package App\Controller\Admin
 * @Route("/card")
 */
class CardController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param CardRepository $cardRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/")
     */
    public function index(Request $request, EntityManagerInterface $em, CardRepository $cardRepository,CardRepository $userRepository)
    {
        $cards = $cardRepository->findAll();
        $users = $userRepository->findAll();

        return $this->render('card/index.html.twig', [
            'cards' => $cards,
            'users' => $users,
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param CardGenerator $cardGenerator
     * @Route("/edit")
     */
    public function edit(Request $request, EntityManagerInterface $em,CardGenerator $cardGenerator,CardRepository $cardRepository)
    {

        $card = new Card();

        $cardCreate= $cardGenerator->generate(6);

        $card->setCodeCard($cardCreate['codeCarte']);
        $card->setChecksum($cardCreate['checkMod']);
        $this->addFlash('success', 'La carte est enregistrée.');

        //enregistrement en bdd
        $em->persist($card);
        $em->flush();
        $cards = $cardRepository->findAll();
        $cardLast=end($cards);
        return $this->render('/card/edit.html.twig',
            [
                'cardLast' => $cardLast
            ]
        );
    }

    /**
     * @param EntityManagerInterface $em
     * @param Card $card
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}")
     */
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
}
