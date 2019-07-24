<?php


namespace App\Card\EventListener;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\Event;

class CardSubscriber implements EventSubscriberInterface
{
    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.fidelity_cards.completed.created' => 'onNewCard'
        ];
    }


    /**
     * @param Event $event
     */
    public function onNewCard(Event $event)
    {

        $this->logger->info('Une carte à été créée');

    }
}