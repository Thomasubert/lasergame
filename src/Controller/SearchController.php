<?php


namespace App\Controller;

use App\Form\SearchCardType;
use App\Form\SearchType;
use App\Form\SearchUserType;
use App\Repository\CardRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/user", name="search_user")
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
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/card", name="search_card")
     *
     */

    public function searchCard(Request $request, CardRepository $cardRepository)
    {
        $searchCardForm = $this->createForm(SearchCardType::class);

        if($searchCardForm->handleRequest($request)->isSubmitted() && $searchCardForm->isValid())
        {
            $criteria = $searchCardForm->getData();

            $card = $cardRepository->searchCard($criteria);

            return $this->render('search/card.html.twig',
                [
                    'card' => $card,
                    'search_form' => $searchCardForm->createView(),
                ]);

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

    /**
     * @param EntityManagerInterface $em
     * @param CardRepository $cardRepository
     * @param UserRepository $userRepository
     * @param Request $request
     * @Route("/card_user", name="search_card_user")
     */
    public function search(EntityManagerInterface $em, CardRepository $cardRepository, UserRepository $userRepository, Request $request)
    {
        // je creer le fomulaire
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        //je récupère les données de l'entité card
        $cards = $cardRepository->findAll();

        //$user = [];

        //validation du formulaire
        if ($form->isSubmitted() && $form->isValid()){

            foreach ($cards as $key => $value){

                //là on dit que les valeurs entrées dans les 3 input doivent correspondre aux valeurs en base de données
                if (($request->request->get('codeCenter')== $value->getCodeCentre())
                && ($request->request->get('codeCard')== $value->getCodeCard())
                    && ($request->request->get('checkSum')== $value->getChecksum())){

                    //je cherche à récupérer l'user
                    $user = $this->getUser();

                    return $this->render('search/search.html.twig',[
                        'user' => $user,
                        'form' => $form->createView()

                    ]);

                }
            }
        }

        $user = $form->getData();

        return $this->render('search/search.html.twig',[
            'user' => $user,
            'form' => $form->createView()

        ]);
    }
}
