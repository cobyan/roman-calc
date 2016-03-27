/*
1   I
2   II
3   III
4   IV
5   V
6   VI
12  XII
18  XVIII
24  XXIV
32  XXXII
199 CXCIX
499 CDXCIX
399 CCCXCIX
3999 MMMCMXCIX

I:1(3) [- V,X],V:5(1),X:10(3) [- L,C],L:50(1),C:100(3) [- D,M],D:500(1),M:1000(4)

*/

/*
$rom_numerals = [
    ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'], // I,V,X
    ['', 'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC'], // X,L,C
    ['', 'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM'], // C,D,M
    ['', 'M', 'MM', 'MMM'] // M
];
*/

// (($_rom == 'I' && in_array($rom[$i+1], ['V','X'])) ||
// ($_rom == 'X' && in_array($rom[$i+1], ['L','C'])) ||
// ($_rom == 'C' && in_array($rom[$i+1], ['D','M'])))


$r = ['I','V', 'X', 'L', 'C', 'D', 'M'];
//     0   1    2    3    4    5    6
//     1   5   10   50  100  500 1000