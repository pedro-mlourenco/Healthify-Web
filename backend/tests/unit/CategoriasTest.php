<?php
namespace backend\tests;

use app\models\Category;

class CategoriasTest extends \Codeception\Test\Unit
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
    public function testCriarCategoria()
    {
        $meal = new Category();

        $meal->name = 'Carnes';
        $this->assertTrue($meal->validate(['name']));

        $meal->description = 'Um frango bem assado na grelha';
        $this->assertTrue($meal->validate(['description']));

        $this->assertTrue($meal->save());
    }

    public function testCriarCategoriaInvalida()
    {
        $meal = new Category();

        $meal->name = 'Carnes asdasdasdasdadasasddasdsasaddsasdadasdasasddasdasdas';
        $this->assertFalse($meal->validate(['name']));

        $meal->description = 'Um frango bem assado na grelha grelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelhagrelha';
        $this->assertFalse($meal->validate(['description']));

        $this->assertFalse($meal->save());
    }
}