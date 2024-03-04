<?php
namespace backend\tests;

use app\models\Meals;

class MealsTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCriarRefeicao()
    {
        $meal = new Meals();

        $meal->name = 'Frango Assado';
        $this->assertTrue($meal->validate(['name']));

        $meal->price = '12.99';
        $this->assertTrue($meal->validate(['price']));

        $meal->description = 'Um frango bem assado na grelha';
        $this->assertTrue($meal->validate(['description']));

        $meal->categoryid = '3';
        $this->assertTrue($meal->validate(['categoryid']));

        $this->assertTrue($meal->save());
    }

    public function testCriarRefeicaoInvalida()
    {
        $meal = new Meals();

        $meal->name = 'Frango Assado asdasdasdasdadasasddasdsasaddsasdadasdasasddasdasdas';
        $this->assertFalse($meal->validate(['name']));

        $meal->price = 'muito caro';
        $this->assertFalse($meal->validate(['price']));

        $meal->description = 'Um frango bem assado na grelha grelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelha';
        $this->assertFalse($meal->validate(['description']));

        $meal->categoryid = 'weee';
        $this->assertFalse($meal->validate(['categoryid']));

        $this->assertFalse($meal->save());
    }
}