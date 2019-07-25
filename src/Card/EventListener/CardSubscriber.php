<?php


namespace App\Card\EventListener;


use App\Card\Mailing;
use App\Entity\Card;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\Event;

class CardSubscriber implements EventSubscriberInterface
{
    private $logger, $mailing;
    public function __construct(LoggerInterface $logger, Mailing $mailing)
    {
        $this->logger = $logger;
        $this->mailing = $mailing;
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.fidelity_cards.completed.activation' => 'onNewCard'
        ];
    }


    /**
     * @param Event $event
     */
    public function onNewCard(Event $event)
    {
        $card = $event->getSubject();
            /** @var Card $card*/
        $this->logger->info('Une carte à été créée : '. $card->getCodeCentre(). $card->getCodeCard(). $card->getChecksum());

        $this->mailing->index($card);
    }
}