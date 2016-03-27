<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 27/03/16
 * Time: 13:40
 */

namespace Cobyan;


class RomanNumeral
{
    protected $numeral;
    private $values;
    public $length;

    /**
     * RomanNumeral constructor.
     * @throws \Exception
     * @param $numeral string
     */
    public function __construct($numeral)
    {
        $this->values = ['I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000];

        $this->numeral = '';
        if(empty($numeral)) {
            return;
        } elseif(!is_string($numeral)) {
            throw new \Exception('Roman numeral should be a sting ('.gettype($numeral).' given)');
        } elseif($this->validate($numeral)) {
            $this->numeral = $numeral;
        }
    }

    /**
     * Checks if the passed $numeral is a valid roman numeral
     * @param $numeral string
     * @return boolean
     */
    public function validate($numeral)
    {
        return boolval(preg_match('/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/', $numeral));
    }

    public function getPrimitives()
    {
        return $this->values;
    }

    public function getPrimitiveValue($primitive)
    {
        return $this->values[$primitive];
    }

    public function getLength()
    {
        return strlen($this->numeral);
    }

    public function getNumeral()
    {
        return $this->numeral;
    }

    public function __toString()
    {
        return $this->numeral;
    }
}