<?php
/*
    URL: https://www.codewars.com/kata/5254ca2719453dcc0b00027d
    In this kata you have to create all permutations of a non empty input string and remove duplicates, if present. This means, you have to shuffle all letters from the input in all possible orders.

    Examples:

    * With input 'a'
    * Your function should return: ['a']
    * With input 'ab'
    * Your function should return ['ab', 'ba']
    * With input 'aabb'
    * Your function should return ['aabb', 'abab', 'abba', 'baab', 'baba', 'bbaa']
    The order of the permutations doesn't matter.
 */

/**
 * @param string $s
 * @return array
 */
function permutations(string $s): array
{
    $result = [];
    $permutation_count = get_permutation_count($s);

    while (true) {
        if (count($result) === $permutation_count) {
            break;
        }

        $temp = str_shuffle($s);

        if (!in_array($temp, $result)) {
            $result[] = $temp;
        }
    }

    return $result;
}

/**
 * @param string $s
 * @return float|int
 */
function get_permutation_count(string $s): float|int
{
    $arr = str_split($s);
    $divisor = 1;

    $data_for_formula = [
        'dividend' => count($arr),
        'els' => []
    ];

    foreach ($arr as $el) {
        if (!isset($data_for_formula['els'][$el])) {
            $data_for_formula['els'][$el] = 1;
        } else {
            $data_for_formula['els'][$el]++;
        }
    }

    foreach ($data_for_formula['els'] as $el) {
        $divisor *= get_fact($el);
    }

    return get_fact($data_for_formula['dividend']) / $divisor;
}

/**
 * @param int $num
 * @return int
 */
function get_fact(int $num): int
{
    $factorial = 1;

    for ($x = $num; $x >= 1; $x--) {
        $factorial = $factorial * $x;
    }

    return $factorial;
}
