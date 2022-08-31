<?php
/*
    URL: https://www.codewars.com/kata/513e08acc600c94f01000001
    The rgb function is incomplete. Complete it so that passing in RGB decimal values will result in a hexadecimal representation being returned. Valid decimal values for RGB are 0 - 255. Any values that fall out of that range must be rounded to the closest valid value.

    Note: Your answer should always be 6 characters long, the shorthand with 3 will not work here.

    The following are examples of expected output values:

    rgb(255, 255, 255); // returns FFFFFF
    rgb(255, 255, 300); // returns FFFFFF
    rgb(0, 0, 0); // returns 000000
    rgb(148, 0, 211); // returns 9400D3
 */

/**
 * @param int $r
 * @param int $g
 * @param int $b
 * @return string
 */
function rgb(int $r, int $g, int $b): string
{
    $arrayValues = [$r, $g, $b];
    $output = '';

    for ($i = 0; $i < count($arrayValues); $i++) {
        if (0 > $arrayValues[$i] || $arrayValues[$i] > 255) {
            $arrayValues[$i] = $arrayValues[$i] > 255 ? 255 : 0;
        }

        $arrayValues[$i] = strval(dechex($arrayValues[$i]));

        if (strlen($arrayValues[$i]) == 1) {
            $arrayValues[$i] = '0' . $arrayValues[$i];
        }

        $output .= $arrayValues[$i];
    }

    return strtoupper($output);
}