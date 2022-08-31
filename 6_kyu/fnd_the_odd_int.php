<?php
/*
    URL: https://www.codewars.com/kata/54da5a58ea159efa38000836
    Given an array of integers, find the one that appears an odd number of times.

    There will always be only one integer that appears an odd number of times.

    Examples
    [7] should return 7, because it occurs 1 time (which is odd).
    [0] should return 0, because it occurs 1 time (which is odd).
    [1,1,2] should return 2, because it occurs 1 time (which is odd).
    [0,1,0,1,0] should return 0, because it occurs 3 times (which is odd).
    [1,2,2,3,3,3,4,3,3,3,2,2,1] should return 4, because it appears 1 time (which is odd).
 */
/**
 * @param array $seq
 * @return int
 */
function findIt(array $seq): int
{
    $sortArr = array_values(array_unique($seq));

    for ($i = 0; $i < count($sortArr); $i++) {
        for ($j = 0, $k = 0; $j <= count($seq); $j++) {
            if ($sortArr[$i] == $seq[$j]) {
                $k++;
            } else if (($j == count($seq)) && !($k % 2 == 0)) {
                return $sortArr[$i];
            }
        }
    }

    return 0;
}