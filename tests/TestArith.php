<?php
namespace EvaluationTest;

require_once __DIR__ . '/../autoloader.php';

class TestArith extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testAddUnits()
    {
        $arith = new \Evaluation\Arith('one');
        $this->assertEquals('five', $arith->add('four'));
    }

    /**
     * @test
     */
    public function testAddTens()
    {
        $arith = new \Evaluation\Arith('one');
        $this->assertEquals('twenty six', $arith->add('twenty five'));
    }

    /**
     * @test
     */
    public function testAddHundreds()
    {
        $arith = new \Evaluation\Arith('one');
        $this->assertEquals('one hundred and twenty six', $arith->add('one hundred and twenty five'));
    }
}