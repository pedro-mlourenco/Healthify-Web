<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class UserCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CreateUserTest(FunctionalTester $I)
    {
        $I->amLoggedInAs('5');
        $I->amOnPage('/');
        $I->see('Gestor de Utilizadores');
        $I->click('Gestor de Utilizadores');
        $I->see('Criar Utilizador');
        $I->click('Criar Utilizador');

        $I->fillField('#usercreateform-username', 'TestUser');
        $I->fillField('#usercreateform-email', 'testmail@gmail.com');
        $I->fillField('#usercreateform-password', '12345678');

        $I->click('Gravar novo utilizador');
    }

    public function CreateInvalidUserTest(FunctionalTester $I)
    {
        $I->amLoggedInAs('5');
        $I->amOnPage('/');
        $I->see('Gestor de Utilizadores');
        $I->click('Gestor de Utilizadores');
        $I->see('Criar Utilizador');
        $I->click('Criar Utilizador');

        $I->fillField('#usercreateform-username', '');
        $I->fillField('#usercreateform-email', 'wrong');
        $I->fillField('#usercreateform-password', '12345');

        $I->click('Gravar novo utilizador');
        $I->see('Email is not a valid email address.');
        $I->see('Password should contain at least 8 characters.');
        $I->see('Username cannot be blank.');
    }
}
