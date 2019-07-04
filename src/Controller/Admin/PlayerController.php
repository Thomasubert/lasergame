<?php


namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\PlayerType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayerController
 * @package App\Controller\Admin
 *
 * @Route("/player")
 */
class PlayerController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/edit/{id}", defaults={"id": null}, requirements={"id": "\d+"})
     */
    public function edit (Request $request,
                          EntityManagerInterface $em,
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
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Le joueur est enregistré');

                return $this->redirectToRoute('');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('/player/edit.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}