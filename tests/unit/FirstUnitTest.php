<?php namespace App\Tests;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class FirstUnitTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testUsernameAndPass()
    {

        $myUsername = 'username';
        $myPassword = 'p455w0rd';
        $myUsername1 = 'B00098054';
        $myPassword1 = 'MyPassIrelandDublin20';

        $user = new User();
        $user1 = new User();

        $user->setUsername("$myUsername");
        $user->setPassword("$myPassword");

        $user1->setUsername("$myUsername1");
        $user1->setPassword("$myPassword1");


        $this->assertEquals($myUsername, $user->getUsername());
        $this->assertEquals($myPassword, $user->getPassword());

        $this->assertEquals($myUsername, $user->getUsername());
        $this->assertEquals($myPassword, $user->getPassword());
    }
}