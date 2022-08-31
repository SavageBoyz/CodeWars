<?php
/*
    URL: https://www.codewars.com/kata/5324945e2ece5e1f32000370
    Given the string representations of two integers, return the string representation of the sum of those integers.

    For example:

    sumStrings('1','2') // => '3'
    A string representation of an integer will contain no characters besides the ten numerals "0" to "9".
 */

/**
 * @param string $a
 * @param string $b
 * @return string
 */
function sum_strings(string $a, string $b): string
{
    $a_arr = get_arr_from_str(make_valid_str($a));
    $b_arr = get_arr_from_str(make_valid_str($b));
    $result = '';

    if (count($a_arr) > count($b_arr)) {
        $bigger_term = $a_arr;
        $less_term = $b_arr;
    } else {
        $bigger_term = $b_arr;
        $less_term = $a_arr;
    }

    for ($bigger_term_len = count($bigger_term) - 1,
         $less_term_len = count($less_term) - 1,
         $reminder = 0; $bigger_term_len >= 0; $bigger_term_len--, $less_term_len--) {

        if ($bigger_term_len === 0 && $less_term_len < 0) {
            $temp_val = (int)$bigger_term[$bigger_term_len] + $reminder;
            $result = ($temp_val) . $result;
            break;
        }

        if ($less_term_len < 0) {
            $temp_val = (int)$bigger_term[$bigger_term_len] + $reminder;

            if ($temp_val >= 10) {
                $result = ($temp_val - 10) . $result;
                $reminder = 1;
            } else {
                $result = ($temp_val) . $result;
                $reminder = 0;
            }

            continue;
        }

        $temp_val = (int)$bigger_term[$bigger_term_len] + (int)$less_term[$less_term_len] + $reminder;

        if ($temp_val >= 10 && $bigger_term_len !== 0) {
            $result = ($temp_val - 10) . $result;
            $reminder = 1;
        } else {
            $result = $temp_val . $result;
            $reminder = 0;
        }
    }

    return $result;
}

/**
 * @param string $str
 * @return string
 */
function make_valid_str(string $str): string
{
    $offset = 0;

    for ($i = 0, $r_len = strlen($str); $i < $r_len; $i++) {
        if ($str[$i] == 0) {
            $offset = $i + 1;
        } else {
            break;
        }
    }

    return substr($str, $offset);
}

/**
 * @param string $str
 * @return array
 */
function get_arr_from_str(string $str): array
{
    $result = [];

    for ($i = 0, $str_count = strlen($str); $i < $str_count; $i++) {
        $result[] = $str[$i];
    }

    return $result;
}