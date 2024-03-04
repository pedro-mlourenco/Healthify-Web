<?php
namespace frontend\tests;

use Codeception\Test\Unit;
use frontend\models\Userprofile;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    function testInvalidUser()
    {
        $pessoa = new Userprofile();

        $pessoa->name = 'Pedroooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo';
        $this->assertFalse($pessoa->validate(['name']));

        $pessoa->nif = 123123123332;
        $this->assertFalse($pessoa->validate(['nif']));

        $pessoa->cellphone = 'asdfghsjkl';
        $this->assertFalse($pessoa->validate(['cellphone']));

        $pessoa->street = 'dsaadsdaswqewqeqwasddadasasdsdsaadasdasdsaweqqewasddas';
        $this->assertFalse($pessoa->validate(['street']));

        $pessoa->door = 'pedro@aulas.pt';
        $this->assertFalse($pessoa->validate(['door']));

        $pessoa->floor = 'Segundo andar direito asdadadsasdasdasd man adsadsas';
        $this->assertFalse($pessoa->validate(['floor']));

        $pessoa->city = 'CidadeXPTOawsdasdasdasdasdasdasdasdasdasdawdqweqqeweqw';
        $this->assertFalse($pessoa->validate(['city']));

        $pessoa->userid = 'wrong';
        $this->assertFalse($pessoa->validate(['userid']));

        $this->assertFalse($pessoa->save());
    }

     function testValidUserFeature()
     {
         $pessoa = new Userprofile();

         $pessoa->name = 'Pedro';
         $this->assertTrue($pessoa->validate(['name']));

         $pessoa->nif = 123456789;
         $this->assertTrue($pessoa->validate(['nif']));

         $pessoa->cellphone = 123456789;
         $this->assertTrue($pessoa->validate(['cellphone']));

         $pessoa->street = 'Morro do Lena';
         $this->assertTrue($pessoa->validate(['street']));

         $pessoa->door = '45';
         $this->assertTrue($pessoa->validate(['door']));

         $pessoa->floor = 'Segundo direito';
         $this->assertTrue($pessoa->validate(['floor']));

         $pessoa->city = 'Leiria';
         $this->assertTrue($pessoa->validate(['city']));

         $pessoa->userid = 2;
         $this->assertTrue($pessoa->validate(['userid']));

         $pessoa->save();

         //$this->tester->seeInDatabase('userprofiles', ['userid' => '2']);

         //Teste READ
         $this->assertEquals('Pedro', $pessoa->name);

         //Teste Update
         $pessoa->name = 'Gil';
         $pessoa->save();
         $this->assertEquals('Gil', $pessoa->name);
     }
}