<?php

/**
 * Created by PhpStorm.
 * User: marco
 * Date: 27/03/16
 * Time: 14:26
 */

namespace Cobyan;

class RomanNumeralConverter
{
    /**
     * Riceve in input un carattere numerico e la posizione nella stringa
     * e ritorna il corrispondente numero romano
     * //  original num: 999
     * // $num:9
     * // position:0
     * @param $num
     * @param $position
     * @return string
     */
    private function rommap($num, $position)
    {

        $roman_primitives = ['I','V', 'X', 'L', 'C', 'D', 'M'];
        //     0   1    2    3    4    5    6

        $r_tuple = array_slice($roman_primitives, $position*2, 3);

        $out = "";
        switch($num) {
            case "0":
                return $out;
                break;
            case "9":
                $out = str_pad($r_tuple[2],2,$r_tuple[0],STR_PAD_LEFT);
                break;
            case "5":
                $out =  $r_tuple[1];
                break;
            case $num<5:
                if($num<=3) {
                    $out = str_pad($out,$num,$r_tuple[0],STR_PAD_LEFT);
                } else {
                    $out = str_pad($r_tuple[1],2,$r_tuple[0],STR_PAD_LEFT);
                }
                break;
            case $num>5 && $num<9:
                if($num>6) {
                    $out = str_pad($r_tuple[1]?: '',$num-4,$r_tuple[0],STR_PAD_RIGHT);
                } else {
                    $out = str_pad($r_tuple[1],2,$r_tuple[0],STR_PAD_RIGHT);
                }
                break;
        }

        return $out;

    }

    /**
     * @param $int
     * @return int|string
     */
    public function fromInt($int)
    {
        return $this->int2rom($int);
    }

    public function toInt($roman_numeral)
    {
        if(empty($roman_numeral)) return null;
        if($roman_numeral instanceof RomanNumeral) {
            $roman_numeral = (string) $roman_numeral;
        }
        return $this->rom2int($roman_numeral);
    }

    function int2rom($int)
    {
        // Due to the limitions of the roman number system you can only convert numbers from 1 to 3999.
        if($int <= 0 || $int>3999) return '';

        $int_string = "$int";
        $int_string_length = strlen($int_string);

        $rom = "";

        for($i=$int_string_length-1;$i>=0;$i--) {
            $rom = $this->rommap($int_string[$i], $int_string_length-1 -$i) . $rom;
        }

        return $rom;
    }

    /**
     * @param $rom
     * @return int|string
     */
    function rom2int($rom)
    {
        $romanNumeral = new RomanNumeral($rom);

        $rom2int = 0;
        $primitives = array_keys($romanNumeral->getPrimitives());
        $numeral_length = $romanNumeral->getLength();

        for($i=0;$i<$numeral_length;$i++) {

            $_rom = $rom[$i];
            $_int = $romanNumeral->getPrimitiveValue($_rom);
            $s_start = array_search($_rom, $primitives);

            $family = [];
            if($s_start<count($primitives)-1) {
                $family = array(@$primitives[$s_start +1], @$primitives[$s_start +2]);
            }
            if( $numeral_length-1 > $i &&

                ($s_start % 2 == 0) &&
                in_array($rom[$i+1], $family)
            ){
                $rom2int -= $_int;
            }

            else

            {
                $rom2int += $_int;
            }
        }
        return $rom2int;
    }
}