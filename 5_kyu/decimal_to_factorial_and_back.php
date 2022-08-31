<?php
/*
    URL: https://www.codewars.com/kata/54e320dcebe1e583250008fd
    Coding decimal numbers with factorials is a way of writing out numbers in a base system that depends on factorials, rather than powers of numbers.

    In this system, the last digit is always 0 and is in base 0!. The digit before that is either 0 or 1 and is in base 1!. The digit before that is either 0, 1, or 2 and is in base 2!, etc. More generally, the nth-to-last digit is always 0, 1, 2, ..., n and is in base n!.

    Read more about it at: http://en.wikipedia.org/wiki/Factorial_number_system

    Example
    The decimal number 463 is encoded as "341010", because:

    463 = 3×5! + 4×4! + 1×3! + 0×2! + 1×1! + 0×0!

    If we are limited to digits 0..9, the biggest number we can encode is 10!-1 (= 3628799). So we extend 0..9 with letters A..Z. With these 36 digits we can now encode numbers up to 36!-1 (= 3.72 × 1041)

    Task
    We will need two functions. The first one will receive a decimal number and return a string with the factorial representation.

    The second one will receive a string with a factorial representation and produce the decimal representation.

    Given numbers will always be positive.
 */
const ALPHABET = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

/**
 * @param int $nb
 * @return string
 */
function dec2FactString(int $nb): string
{
    $next_num = $nb;
    $output = [];

    for($i = 1; ; $i++){
        $remainder = ($next_num - intval($next_num / $i) * $i);
        $next_num = intval($next_num / $i);

        if($remainder < 10){
            $output[] = $remainder;
        }else{
            $output[] = ALPHABET[$remainder - 10];
        }

        var_dump($output[$i - 1]);

        if($next_num == 0){
            break;
        }
    }

    return implode(array_reverse($output));
}

/**
 * @param string $str
 * @return int
 */
function factString2Dec(string $str): int
{
    $output_array = array();
    $temp_length = strlen($str);

    for($i = 0; $i < strlen($str) - 1; $i++){
        $temp_length -= 1;

        if($i == 0){
            $output_array[$i] = $str[$i] * $temp_length + ($str[$i + 1]);
            continue;
        }

        $output_array[$i] = $output_array[$i - 1] * $temp_length + intval($str[$i+1]);
    }

    return end($output_array);
}