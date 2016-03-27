<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 27/03/16
 * Time: 15:13
 */

namespace Cobyan;


class RomanNumeralTest extends \PHPUnit_Framework_TestCase
{

    protected $Converter;

    public function illegalNumbersProvider() {
        return array(
            ['VIIII', true],
            ['MMMMMC', true],
            ['ICMMMM', true],
            ['LLCXXXXXV', true],
            ['I', false],
        );
    }

    /**
     * @param $rom string
     * @param $expected string
     * @dataProvider illegalNumbersProvider
     */
    public function testLegalNumbers($rom, $expected)
    {
        $this->Converter = new RomanNumeralConverter();
        $this->assertEquals($expected, 'Illegal number' == $this->Converter->rom2int($rom));
    }

    /**
     * @expectedException \Exception
     */
    public function testIllegalNumeral()
    {
        $numeral = new RomanNumeral(15);
        $this->assertNotInstanceOf('RomanNumeral', $numeral);
    }

    public function testNumeral()
    {
        $Numeral = new RomanNumeral('CXVII');
        $this->assertEquals('CXVII', $Numeral->getNumeral());
    }


}
