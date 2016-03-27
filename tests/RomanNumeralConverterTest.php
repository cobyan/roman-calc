<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 27/03/16
 * Time: 15:09
 */

namespace Cobyan;


class RomanNumeralConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RomanNumeralConverter
     */
    protected $Converter;

    public function setUp()
    {
        $this->Converter = new RomanNumeralConverter();
    }

    public function numeralsProvider() {
        return array(
            ['VI',6],
            ['VII', 7],
            ['XII', 12],
            ['XXVII', 27],
            ['CXXIII', 123],
            ['CCCXXI', 321],
            ['MMXVI', 2016],
            ['CMXCIX',999]
        );
    }
    /**
     * @param $rom
     * @param $expected_int
     * @dataProvider numeralsProvider
     */
    public function testRom2Int($rom, $expected_int)
    {
        $int = $this->Converter->rom2int($rom);
        $this->assertEquals($expected_int, $int);
    }

    /**
     * @param $int
     * @param $expected_rom
     * @dataProvider numeralsProvider
     */
    public function testInt2Rom($expected_rom, $int)
    {
        $rom = $this->Converter->int2rom($int);
        $this->assertEquals($expected_rom, $rom);
    }
}
