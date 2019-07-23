<?php


namespace App\Tests\AppBundle\Entity;

use ApiPlatform\Core\Tests\Fixtures\TestBundle\Entity\User;
use App\Controller\UserController;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
   public function EditUser()
   {
       $user = new User('John', [], 'ty@ty.fr', 'ty@ty.fr', UserController::class,20);
       $this->assertSame(1.1, $user->Edit());
   }
}