<?php


namespace App\Controller;

use App\Form\SearchUserType;
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

            dd($user);

        }
        return $this->render('search/user.html.twig',
            [
                'search_form' => $searchUserForm->createView(),
            ]);
    }
}