# Roman Calculator #

_playing with Unit Tests and refactoring, 
any feedback welcome_

## Primitives ##

Pos|Num|Val|Max in a row| Subtract if precedes|
---|---|---|----|-|
0| **I** |  1  | 3  | V _or_ X |
1| **V** |  5  | 1  | |
2| **X** | 10  | 3  | L _or_ C |
3| **L** | 50  | 1  | |
4| **C** | 100 | 3  | D _or_ M |
5| **D** | 500 | 1  | | 
6| **M** | 1000| 4  | |

## Series ##

group|values|pivots|
-|-|-|
units|I, 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX' | I,V,X |
tens |'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC' | X,L,C |
hundreds|'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM' | C,D,M |
thousands|'M', 'MM', 'MMM' | M

## Sample numbers ##
Int| Rom |
---|-----|
1  | I   |
2  | II  |
3  | III |
4  | IV  |
5  | V   |
6  | VI  |
12 | XII |
18 | XVIII|
24 | XXIV|
32 | XXXII|
199| CXCIX|
499| CDXCIX|
399| CCCXCIX|
3999| MMMCMXCIX|
