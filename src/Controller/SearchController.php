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
 * @Route("/search")
 */
class SearchController extends AbstractController
{

    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/searchuser")
     */
    public function searchUser(Request $request, UserRepository $userRepository)
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


    /**
     * @param Request $request
     * @param CardRepository $cardRepository
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response

     * @Route("/card")

     *
     */

    public function searchcard(Request $request, CardRepository $cardRepository,UserRepository $userRepository)
    {
        $searchCardForm = $this->createForm(SearchCardType::class);
        $card=$cardRepository->findAll();


        if($searchCardForm->handleRequest($request)->isSubmitted() && $searchCardForm->isValid())
        {
            $criteria = $searchCardForm->getData();

            //dd($criteria);

            $card = $cardRepository->searchCard($criteria);



             $checkCardFree=$cardRepository->findFreeCard();


            //dd($card);

            if(empty($card))
            {

                return $this->render('search/card.html.twig',
                    [
                        'card' => $card,
                        'search_form' => $searchCardForm->createView(),
                    ]);
            }
                return $this->render('search/card.html.twig',
                    [
                        'card' => $card,
                        'search_form' => $searchCardForm->createView(),
                    ]);


        }
        return $this->render('search/card.html.twig',
            [

                'search_form' => $searchCardForm->createView(),
            ]);

    }

}