<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class LoginTestCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
    }

    // tests
    public function UserLogin(AcceptanceTester $I)
    {
        $I->expectTo('Login with a user account and be redirected to the homepage');
        $I->fillField('username', 'user');
        $I->fillField('password', 'user');
        $I->click('loginButton');
        $I->see('Logout','.nav-link');
        $I->seeCurrentUrlEquals('/');

        $I->see('Logout', '.nav-link');
        $I->dontSee('Login', '.nav-link');
        $I->dontSee('Admin', '.nav-link');
    }

        public function AdminLogin(AcceptanceTester $I)
    {
        $I->expectTo('Login with an admin account and be redirected to the homepage');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('loginButton');
        $I->see('Logout','.nav-link');
        $I->seeCurrentUrlEquals('/');

        $I->see('Logout', '.nav-link');
        $I->dontSee('Login', '.nav-link');
        $I->See('Admin', '.nav-link');
    }


}
