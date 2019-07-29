<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ApiController
 * @package App\Controller
 */
class GamersController extends AbstractController
{

    /**
     * @Route("/gamers", name="app_api_index", methods={"GET"})
     */
    public function gamers(CardRepository $cardRepository)
    {

        # Créer un service qui récupère via l'API les données des joueurs

        try {

           //dd($cardRepository->findFreeCard());

            $httpClient = HttpClient::create();
            $response = $httpClient->request('GET', 'http://localhost:8001/api/users');

            $users = $response->toArray();

            usort($users, function ($item1, $item2) {return $item2['score'] <=> $item1['score']; });

        } catch (TransportException $exception) {
            dd($exception);
        }



        return $this->render('api/index.html.twig', [
            'users' => $users
        ]);
    }

}
