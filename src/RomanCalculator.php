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
     * @var $converter RomanNumeralConverter
     */
    protected $converter;

    public function __construct($converter)
    {
        $this->setConverter($converter);
    }

    /**
     * @return RomanNumeralConverter
     */
    public function getConverter()
    {
        return $this->converter;
    }

    public function setConverter($converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param $operationSymbol
     * @param $rn1 RomanNumeral
     * @param $rn2 RomanNumeral
     * @return string
     * @throws \Exception
     */
    public function doOp($operationSymbol, $rn1, $rn2)
    {
        $Converter = $this->converter;
        if(empty($rn1) || empty($rn2)) return '';

        $op1 = $Converter->toInt($rn1);
        $op2 = $Converter->toInt($rn2);

        $result = 0;

// if 'eval' wasn't "very dangerous".. (http://php.net/manual/en/function.eval.php)
// $result = eval("$op=".$Converter->toInt($RN1) . "$op". $Converter->toInt($RN2));

        switch($operationSymbol) {
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
                throw new \Exception("Operation not supported: '$operationSymbol'");
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

    function divideBy($rom1, $rom2)
    {
        return $this->doOp('/',
            new RomanNumeral($rom1),
            new RomanNumeral($rom2));
    }

}