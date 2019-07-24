<?php

namespace App\Operation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Controller\GamersController;


class UserPublishingHandler
{
    public function handle(User $data)
    {
        // ...
        // ...

        return true;

     }

}