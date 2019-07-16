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

            //dd($criteria);

            $card = $cardRepository->searchCard($criteria);

            //dd($card);

           // $this->getDoctrine()->getRepository('AppBundle:Card')->findBy(array('status' => $_POST['email']));

            //$checkCardFree = $this->getDoctrine()->getRepository('CardBundle:Card')->find($this->getParameter($getStatus()));

           // $checkCardFree=$cardRepository->findFreeCard($customerCode);
           // $cards=$cardRepository->findAll();

             dd($checkCardFree=$cardRepository->findFreeCard());

            //dd($checkCardFree);

            if(empty($card))
            {

                return $this->render('search/card.html.twig',
                    [
                        'card' => $card,
                        'search_form' => $searchCardForm->createView(),
                    ]);
            }
            elseif($card[0]->getStatus()=="libre")
            {
                //$rowuser=" ";

                $stateCard="La carte non attribué";
                return $this->render('search/card.html.twig',
                    [
                        'card' => $card,
                        'cardstate'=>$stateCard,
                        'search_form' => $searchCardForm->createView(),
                    ]);
            }
            elseif ($card[0]->getStatus()=="attribué")
            {

                //dd($card[0]->getUser());

                return $this->render('search/card.html.twig',
                    [
                        'card' => $card,
                        'rowuser'=>$card[0]->getUser(),
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