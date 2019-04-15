<?php namespace App\Tests;
use App\Tests\AcceptanceTester;
use App\Repository\UserRepository;

class InteractWithVotesTestCest
{

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
    }

    // tests
    public function createVote(AcceptanceTester $I)
    {
        $I->expectTo('Create a vote.');


        $I->seeCurrentUrlEquals('/login');
        $I->fillField('username', 'user');
        $I->fillField('password', 'user');
        $I->click('loginButton');

        $I->amOnPage('/vote');
        $I->seeElement('.btn-primary');
        $I->click('.btn-primary');

        $I->amOnPage('/vote/new');
        $I->fillField('vote[title]', 'Codeception test title');
        $I->fillField('vote[description]', 'Codeception test description');
        $I->fillField('vote[image]', 'https://cdn-images-1.medium.com/max/2400/1*QqRR06wyM_g1XKRup_Bjqw.jpeg');
        $I->fillField('vote[author]','37');
        $I->click('.btn');

        $I->amOnPage('/vote/propositions');
        $I->see('Codeception test title');
        $I->see('Codeception test description');
    }
}
