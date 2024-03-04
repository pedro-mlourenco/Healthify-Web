<?php

namespace frontend\tests;

use app\models\Reservations;

class ReservasTest extends \Codeception\Test\Unit
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

    // tests
    public function testCriarReserva()
    {
        $reserva = new Reservations();

        $reserva->reservedday = '2022-01-05';
        $this->assertTrue($reserva->validate(['reservedday']));

        $reserva->reservedtime = 'almoco';
        $this->assertTrue($reserva->validate(['reservedtime']));

        $reserva->tableid = '2';
        $this->assertTrue($reserva->validate(['tableid']));

        $reserva->userprofilesid = '5';
        $this->assertTrue($reserva->validate(['userprofilesid']));

        $this->assertTrue($reserva->save());
    }

    public function testCriarReservaInvalida()
    {
        $reserva = new Reservations();

        $reserva->reservedday = '';
        $this->assertFalse($reserva->validate(['reservedday']));

        $reserva->reservedtime = '12:25';
        $this->assertFalse($reserva->validate(['reservedtime']));

        $reserva->tableid = 'asd';
        $this->assertFalse($reserva->validate(['tableid']));

        $reserva->userprofilesid = 'asd';
        $this->assertFalse($reserva->validate(['userprofilesid']));

        $this->assertFalse($reserva->save());
    }
}