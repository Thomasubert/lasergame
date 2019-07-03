<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddressController
 * @package App\Controller
 * @Route("/adresse")
 */
class AddressController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request, EntityManagerInterface $em, AddressRepository $addressRepository)
    {
        $address = $addressRepository->findAll();

        return $this->render('address/index.html.twig', [
            'address' => $address,
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $id
     * @Route("/edit/{id}", defaults={"id" : null}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, EntityManagerInterface $em, $id)
    {
        //$user = $factory->get(User::class, $id);
        if (is_null($id)){
            $address = new Address();
        } else {
            $address = $em->find(Address::class, $id);

            if (is_null($address)){
                throw new NotFoundHttpException();
            }
        }

        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->persist($address);
                $em->flush();

                $this->addFlash('success', "L'adresse est enregistrée");

                return $this->redirectToRoute('app_address_index');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('/address/edit.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param EntityManagerInterface $em
     * @param Address $address
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}")
     */
    public function delete(EntityManagerInterface $em, Address $address)
    {
        $em->remove($address);
        $em->flush();

        $this->addFlash('success',"L'adresse est supprimée");

        return $this->redirectToRoute('app_address_index');
    }
}
