<?php
namespace backend\tests;

use app\models\Reservations;

class ReservasTest extends \Codeception\Test\Unit
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
    public function testCriarReserva()
    {
        $reservation = new Reservations();

        $reservation->reservedday = '2022-01-06';
        $this->assertTrue($reservation->validate(['reservedday']));

        $reservation->reservedtime = 'almoco';
        $this->assertTrue($reservation->validate(['reservedtime']));

        $reservation->tableid = '2';
        $this->assertTrue($reservation->validate(['tableid']));

        $reservation->userprofilesid = '5';
        $this->assertTrue($reservation->validate(['userprofilesid']));

        $this->assertTrue($reservation->save());
    }
}