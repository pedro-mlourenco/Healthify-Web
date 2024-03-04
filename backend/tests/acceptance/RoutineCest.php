<?php

namespace backend\tests\acceptance;

use backend\tests\AcceptanceTester;
use yii\helpers\Url;

class RoutineCest
{
    public function checkRoutine(AcceptanceTester $I)
    {
        $I->resizeWindow(1600, 900);
        $I->amOnPage('site/index');
        $I->wait(2);
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('signin-button');
        $I->wait(5);
        $I->see('Zona Administrativa');

        $I->click('Reservas');
        $I->wait(2);
        $I->see('Create Reservations');
        $I->click('Create Reservations');
        $I->fillField('#reservations-reservedday', '2022-01-06');
        $I->click('#reservations-reservedtime');
        $I->wait(1);
        $I->selectOption('#reservations-reservedtime', 'almoco');
        $I->selectOption('#reservations-tableid', '2');
        $I->selectOption('#reservations-userprofilesid', 'admin');
        $I->click('Save');
        $I->wait(2);
        $I->see('ERROR');
        $I->fillField('#reservations-reservedday', '2022-01-07');
        $I->click('#reservations-reservedtime');
        $I->wait(1);
        $I->click('Save');
        $I->wait(2);
        $I->see('2022-01-07');
        $I->wait(4);
        $I->click('Reservations');
        $I->wait(2);
        $I->click('Reservas Futuras');
        $I->wait(2);

        $I->click('#dropdownCaret');
        $I->wait(1);

        $I->click('Sobremesa');
        $I->wait(2);

        $I->click('Create Meal');

        $I->wait(2);

        $I->fillField('#meals-name', 'Mousse de Chocolate');
        $I->fillField('#meals-price', '2.50');
        $I->fillField('#meals-description', 'Mousse de Chocolate caseira');

        $I->wait(2);

        $I->click('Save');

        $I->wait(2);

        $I->click('Back to index');
    }
}
