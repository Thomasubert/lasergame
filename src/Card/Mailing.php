<?php


namespace App\Card;


use App\Entity\Card;
use Twig\Environment;

class Mailing
{
    private $mailer, $twig;
    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }
    public function index(Card $card)
    {
        $message = (new \Swift_Message('Activation d\'une carte'))
            ->setFrom('laser@game.com')
            ->setTo($card->getUser()->getEmail())
            ->setBody(
                $this->twig->render(
                // templates/emails/registration.html.twig
                    'emails/card_activation.html.twig',
                    ['name' => $card->getUser()->getFirstname()]
                ),
                'text/html'
            )


        ;

        $this->mailer->send($message);


    }
}