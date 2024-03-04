<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('signin-button');

        $I->see('Zona Administrativa');
    }

    public function loginFailedUser(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', '123456789');
        $I->click('signin-button');

        $I->see('Incorrect username or password.');
    }


}
