<?php

namespace App\Controller;



use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class GameController
 * @package App\Controller
 * @Route ("game")
 */
class GameController extends AbstractController
{

    /**
     * @Route("/")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param GameRepository $gameRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, EntityManagerInterface $em, GameRepository $gameRepository)
    {
        $games = $gameRepository->findBy(
            [],
            ['name' => 'ASC']
        );
        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }


    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $id
     * @Route("/edit/{id}", defaults={"id": null}, requirements={"id": "\d+"})
     */

    public function edit (Request $request, EntityManagerInterface $em, $id )
    {

        if (is_null($id)){
            $game = new Game();
        } else {
            $game = $em->find(Game::class, $id);

            if (is_null($game)){
                throw new NotFoundHttpException();
            }
        }

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()){
                $em->persist($game);
                $em->flush();

                $this->addFlash('success', 'Nouveau jeu créé!');

                return $this->redirectToRoute('app_game_index');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('/game/edit.html.twig',
        [
            'form' => $form->createView()
        ]
        );
    }


    /**
     * @param EntityManagerInterface $em
     * @param Game $game
     * @Route("/delete/{id}")
     */
    public function delete(EntityManagerInterface $em, Game $game)
    {
        $em->remove($game);
        $em->flush();

        $this->addFlash('success', 'Le jeu est supprimé');

        return $this->redirectToRoute('app_game_index');
    }
}
