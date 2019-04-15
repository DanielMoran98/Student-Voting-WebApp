<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class HomePageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function HomePageTest(AcceptanceTester $I)
    {
        $I->expectTo('Not see the logout button when not signed out.');
        $I->amOnPage('/');
        $I->see('Login', '.nav-link');
        $I->dontSee('Logout', '.nav-link');
    }


}
