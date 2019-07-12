<?php

namespace App\Controller;

use App\Service\CardGenerator;
use App\Entity\Card;
use App\Form\CardType;
use App\Repository\CardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;





/**
 * Class CardController
 * @package App\Controller
 * @Route("card")
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
    public function index(Request $request, EntityManagerInterface $em, CardRepository $cardRepository)
    {
        $cards = $cardRepository->findAll();

        return $this->render('card/index.html.twig', [
            'cards' => $cards,
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
        /*
              if (is_null($id)) {//création
                  $card = new Card();
              } else {//modification
                  $card = $em->find(Card::class, $id);
                  //404 si l'id n'est pas en BDD
                  if (is_null($card)) {
                      throw new NotFoundHttpException();
                  }
              }
        */
        $card = new Card();
        // $form = $this->createForm(CardType::class, $card);
        //$form->handleRequest($request);
        // création du formulaire relié à la catégorie
        //$form = $this->createForm(CardType::class, $id);
        // le formulaire analyse la requête et fait le mapping
        // avec l'entité s'il a été soumis
        //$form->handleRequest($request);
        //var_dump($cardGenerator->generate(6, 9)['codeCarte']);
        //$form->get('codeCard')->setData($cardGenerator->generate(6, 9)['codeCarte']);
        //$form->get('checksum')->setData($cardGenerator->generate(6, 9)['checkMod']);
        $cardCreate= $cardGenerator->generate(6);
        // var_dump($cardCreate['codeCarte']);
        // var_dump($cardCreate['checkMod']);
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
            'app_card_index'
        );

    }

}
