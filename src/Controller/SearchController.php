<?php


namespace App\Controller;

use App\Form\SearchCardType;
use App\Form\SearchUserType;
use App\Repository\CardRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class SearchController
 * @package App\Controller
 * @Route("search")
 */
class SearchController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/user", name="search_user")
     */

    public function searchUser(Request $request, UserRepository $userRepository )
    {
        $searchUserForm = $this->createForm(SearchUserType::class);

        if($searchUserForm->handleRequest($request)->isSubmitted() && $searchUserForm->isValid())
        {
            $criteria = $searchUserForm->getData();

            $user = $userRepository->searchUser($criteria);

            return $this->render('search/user.html.twig',
                [
                    'user' => $user,
                    'search_form' => $searchUserForm->createView(),
                ]);

        }

        $user = $searchUserForm->getData();

        return $this->render('search/user.html.twig',
            [
                'user' => $user,
                'search_form' => $searchUserForm->createView(),
            ]);
    }

    public function searchCard(Request $request,CardRepository $cardRepository )
    {
        $searchCardForm = $this->createForm(SearchCardType::class);

        if($searchCardForm->handleRequest($request)->isSubmitted() && $searchCardForm->isValid())
        {
            $criteria = $searchCardForm->getData();

            $card = $cardRepository->searchCard($criteria);

            return $this->render('search/user.html.twig',
                [
                    'card' => $card,
                    'search_form' => $searchCardForm->createView(),
                ]);

        }

        $user = $searchUserForm->getData();

        return $this->render('search/user.html.twig',
            [
                'user' => $user,
                'search_form' => $searchUserForm->createView(),
            ]);
    }
}