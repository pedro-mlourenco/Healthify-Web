<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class ReservationsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CreateReservationTest(FunctionalTester $I)
    {
        $I->amLoggedInAs('5');
        $I->amOnPage('/');
        $I->see('Reservas');
        $I->click('Reservas');
        $I->see('Create Reservations');
        $I->click('Create Reservations');

        $I->fillField('#reservations-reservedday', '2022-01-06');
        $I->selectOption('#reservations-reservedtime', 'almoco');
        $I->selectOption('#reservations-tableid', '2');
        $I->selectOption('#reservations-userprofilesid', 'admin');

        $I->click('Save');
        $I->see('2022-01-06');
    }
}
