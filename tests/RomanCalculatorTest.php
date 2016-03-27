<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 27/03/16
 * Time: 10:39
 */

namespace Cobyan;


/**
 * Class RomanCalculatorTest
 * @package Cobyan
 */
class RomanCalculatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var RomanCalculator The calculator object
     */
    protected $Calculator;

    public function setUp()
    {
        $Converter = new RomanNumeralConverter();
        $this->Calculator = new RomanCalculator($Converter);
    }

    public function sumsProvider() {
        return array(
            ['VI','VIII',14, 'XIV'],
            ['XII','XXVII', 39, 'XXXIX'],
            ['CXXIII', 'CCCXXI', 444, 'CDXLIV'],
            ['MMXVI', 'CMXCIX', 3015, 'MMMXV'],
        );
    }

    public function subsProvider() {
        return array(
            ['VII', 'VI', 1, 'I'],
            ['VI','VII','', ''],
            ['MMXVI','MMXVI', '', ''],
            ['MMMXV', 'CMXCIX', 2016, 'MMXVI']
        );
    }

    public function timesProvider() {
        return array(
            ['VII', 'VI', 42, 'XLII'],
            ['I','I',1, 'I'],
            ['MMXVI','MMXVI', '', ''],
            ['L', 'XII', 600, 'DC']
        );
    }

    public function byProvider() {
        return array(
            ['VI', 'III', 2, 'II'],
            ['CVXXXII','XII','', ''],
            ['CMLXXXVII', 'XXI', 47 ,'XLVII' ],
            ['L', '', '', ''],
            ['DLXIV', 'IV', 141, 'CXLI']
        );
    }

    /**
     * @param $rom1 string
     * @param $rom2 string
     * @param $expected_sum_int int
     * @param $expected_sum_rom string
     * @dataProvider sumsProvider
     */
    public function testAdd($rom1,$rom2, $expected_sum_int, $expected_sum_rom)
    {
        $sum_rom = $this->Calculator->sum($rom1, $rom2);
        $sum_int = $this->Calculator->getConverter()->toInt($sum_rom);

        $this->assertEquals($expected_sum_rom, $sum_rom);
        $this->assertEquals($sum_rom, $this->Calculator->add($rom1,$rom2));
        $this->assertEquals($expected_sum_int, $sum_int);
    }

    /**
     * @param $rom1 string
     * @param $rom2 string
     * @param $expected_sum_int integer
     * @param $expected_sum_rom string
     * @dataProvider subsProvider
     */
    public function testSub($rom1, $rom2, $expected_sum_int, $expected_sum_rom)
    {
        $sum_rom = $this->Calculator->sub($rom1, $rom2);
        $this->assertEquals($expected_sum_rom, $sum_rom);
        $sum_int = $this->Calculator->getConverter()->toInt($sum_rom);
        $this->assertEquals($expected_sum_int, $sum_int);
    }

    /**
     * @param $rom1
     * @param $rom2
     * @param $expected
     * @dataProvider timesProvider
     */
    public function testTimes($rom1, $rom2, $expected)
    {
        $times_rom = $this->Calculator->times($rom1,$rom2);
        $this->assertEquals($expected,$this->Calculator->getConverter()->toInt($times_rom));
    }

    /**
     * @param $rom1
     * @param $rom2
     * @param $expected
     * @dataProvider byProvider
     */
    public function testBy($rom1, $rom2, $expected)
    {
        $times_rom = $this->Calculator->divideBy($rom1,$rom2);
        $this->assertEquals($expected,$this->Calculator->getConverter()->toInt($times_rom));
    }

    /**
     * @expectedException \Exception
     * @throws \Exception
     */
    public function testDoUnsupportedOpRaiseException()
    {
        $this->Calculator->doOp('@', new RomanNumeral(''), new RomanNumeral(''));
    }
}
