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

        if($searchCardForm->handleRequest($request)->isSubmitted() && $searchCardForm->isValid())
        {
            $criteria = $searchCardForm->getData();

            $card = $cardRepository->searchCard($criteria);

            $users=$userRepository->findAll();

           // dd($card[0]->getStatus());

            if($card[0]->getStatus()=="libre")
            {
                //$rowuser=" ";

                $stateCard="La carte non attribué";
                return $this->render('search/card.html.twig',
                    [
                        'card' => $card,
                        'cardstate'=>$stateCard,
                        //'rowuser'=>$rowuser,
                        'search_form' => $searchCardForm->createView(),
                    ]);
            }
            elseif ($card[0]->getStatus()=="attribué")
            {
                $stateCard="La carte est attribuée";
                $rowuser=" ";
                foreach ($users as $key => $value)
                {

                    if($value->getCard()->getCodeCard()==$card[0]->getCodeCard())
                    {
                        $rowuser=$value;
                        //dd($rowuser);
                    }

                }

                return $this->render('search/card.html.twig',
                    [
                        'card' => $card,
                        'rowuser'=>$rowuser,
                        'cardstate'=>$stateCard,
                        'search_form' => $searchCardForm->createView(),
                    ]);


            }





        }



        $user = $searchCardForm->getData();

        $card = $searchCardForm->getData();


        return $this->render('search/card.html.twig',
            [

                'user' => $user,

                'card' => $card,

                'search_form' => $searchCardForm->createView(),
            ]);
    }
}