<?php


namespace App\Card;


use App\Entity\Card;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Workflow\Registry;

class CardWorkflowHandler
{

    private $workflows, $manager;

    /**
     * CardWorkflowHandler constructor.
     * @param Registry $workflows
     * @param ObjectManager $manager
     */
    public function __construct(Registry $workflows, ObjectManager $manager)
    {
        $this->workflows = $workflows;
        $this->manager = $manager;
    }

    public function handle(Card $card, string $state): void
    {
        //on récupère le workflow
        $workflow = $this->workflows->get($card);

        //on récupère doctrine
        $em = $this->manager;

        //changement du workflow
        $workflow->apply($card, $state);

        //insertion en bdd
        $em->flush();

        //activation de la carte si possible
        if ($workflow->can($card, 'activation')){
            $workflow->apply($card, 'activation');
            $em->flush();
        }
    }
}