<?php
/*
    URL: https://www.codewars.com/kata/52597aa56021e91c93000cb0
    Write an algorithm that takes an array and moves all of the zeros to the end, preserving the order of the other elements.

    moveZeros([false,1,0,1,2,0,1,3,"a"]) // returns[false,1,1,2,1,3,"a",0,0]
 */

/**
 * @param array $items
 * @return array
 */
function moveZeros(array $items): array
{
    for($i = 0; $i < count($items); $i++){
        if( (is_float($items[$i]) || is_int($items[$i])) && $items[$i] == 0){
            unset($items[$i]);
            array_push($items,0);
        }
    }

    return array_values($items);
}