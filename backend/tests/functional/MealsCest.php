<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class MealsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CreateMealsTest(FunctionalTester $I)
    {
        $I->amLoggedInAs('5');
        $I->amOnPage('/');
        $I->see('Carne');
        $I->click('Carne');
        $I->see('Create Meal');
        $I->click('Create Meal');

        $I->fillField('#meals-name', 'Frango Assado');
        $I->fillField('#meals-price', '12.99');
        $I->fillField('#meals-description', 'Frango do bom assado na grelha');

        $I->click('Save');
    }
}
