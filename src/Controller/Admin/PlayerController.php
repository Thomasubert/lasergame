<?php


namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\PlayerType;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class PlayerController
 * @package App\Controller\Admin
 *
 * @Route("/player")
 */
class PlayerController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index(UserRepository $repository)
    {
        $users = $repository->findBy([], ['lastname' => 'ASC']);

        return $this->render('admin/index.html.twig',[
            'users' => $users
        ]);
    }
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/edit/{id}", defaults={"id": null}, requirements={"id": "\d+"})
     */
    public function edit (Request $request,
                          EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder,
                          $id)
    {

        if (is_null($id)){
            $user = new User();
        } else {
            $user = $em->find(User::class, $id);

            if (is_null($user)){
                throw new NotFoundHttpException();
            }
        }

        $form = $this->createForm(PlayerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $password = $passwordEncoder->encodePassword(
                    $user,
                    $user->getPassword()
                );

                $user->setPassword($password);

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Le joueur est enregistré');

                return $this->redirectToRoute('app_admin_player_edit');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('/admin/edit.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/suppression/{id}")
     */
    public function delete(EntityManagerInterface $em, User $user)
    {
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', "Le joueur est supprimé");

        return $this->redirectToRoute('app_admin_player_index');
    }
}