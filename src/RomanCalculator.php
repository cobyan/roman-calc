<?php

/**
 * Created by PhpStorm.
 * User: marco
 * Date: 27/03/16
 * Time: 10:19
 */

namespace Cobyan;

class RomanCalculator
{
    /**
     * @var RomanNumeralConverter
     */
    protected $Converter;

    public function __construct($Converter)
    {
        $this->setConverter($Converter);
    }

    /**
     * @return RomanNumeralConverter
     */
    public function getConverter()
    {
        return $this->Converter;
    }

    public function setConverter($Converter)
    {
        $this->Converter = $Converter;
    }

    /**
     * @param $op
     * @param $RN1 RomanNumeral
     * @param $RN2 RomanNumeral
     * @return string
     * @throws \Exception
     */
    public function doOp($op, $RN1, $RN2)
    {
        $Converter = $this->Converter;
        if(empty($RN1) || empty($RN2)) return '';

        $op1 = $Converter->toInt($RN1);
        $op2 = $Converter->toInt($RN2);

        $result = 0;

// if 'eval' wasn't "very dangerous".. (http://php.net/manual/en/function.eval.php)
// $result = eval("$op=".$Converter->toInt($RN1) . "$op". $Converter->toInt($RN2));

        switch($op) {
            case '+':
                $result = $op1 + $op2;
                break;
            case '-':
                $result = $op1 - $op2;
                break;
            case '*':
                $result = $op1 * $op2;
                break;
            case '/':
                if($op2 > 0) {
                    $result = $op1 / $op2;
                }
                break;
            default:
                throw new \Exception("Operation not supported: '$op'");
        }

        $rom_result = '';
        if($result > 0) {
            $rom_result = $Converter->fromInt($result);
        }

        return $rom_result;
    }

    /**
     * @param $rom1 string
     * @param $rom2 string
     * @return string Roman numeral
     */
    function sum($rom1, $rom2)
    {
        return  $this->doOp('+',
            new RomanNumeral($rom1),
            new RomanNumeral($rom2));
    }

    function add($rom1, $rom2) {
        return $this->sum($rom1, $rom2);
    }

    function sub($rom1, $rom2)
    {
        return $this->doOp('-',
            new RomanNumeral($rom1),
            new RomanNumeral($rom2));
    }

    function times($rom1, $rom2)
    {
        return $this->doOp('*',
            new RomanNumeral($rom1),
            new RomanNumeral($rom2));
    }

    function by($rom1, $rom2)
    {
        return $this->doOp('/',
            new RomanNumeral($rom1),
            new RomanNumeral($rom2));
    }

}