<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class IngredientsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CreateIngredientTest(FunctionalTester $I)
    {
        $I->amLoggedInAs('5');
        $I->amOnPage('/');
        $I->see('Lista de Ingredientes');
        $I->click('Lista de Ingredientes');
        $I->see('Create Ingredients');
        $I->click('Create Ingredients');

        $I->fillField('#idPesquisa', 'chicken breast');
        $I->click('#idBtSearch');

        $I->click('Save');
    }
}
