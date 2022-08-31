<?php
/*
    URL: https://www.codewars.com/kata/5277c8a221e209d3f6000b56
    Write a function that takes a string of braces, and determines if the order of the braces is valid. It should return true if the string is valid, and false if it's invalid.

    This Kata is similar to the Valid Parentheses Kata, but introduces new characters: brackets [], and curly braces {}. Thanks to @arnedag for the idea!

    All input strings will be nonempty, and will only consist of parentheses, brackets and curly braces: ()[]{}.

    What is considered Valid?
    A string of braces is considered valid if all braces are matched with the correct brace.

    Examples
    "(){}[]"   =>  True
    "([{}])"   =>  True
    "(}"       =>  False
    "[(])"     =>  False
    "[({})](]" =>  False
 */

/**
 * @param string $braces
 * @return bool
 */
function validBraces(string $braces): bool
{
    $openBraces = ['(' => ')', '[' => ']', '{' => '}'];
    $bracesStack = [];

    for ($i = 0; $i < strlen($braces); $i++) {
        if (array_key_exists($braces[$i], $openBraces)) {
            $bracesStack[] = $braces[$i];
        } else if (empty($bracesStack) || $openBraces[array_pop($bracesStack)] !== $braces[$i]) {
            return false;
        }
    }

    return empty($bracesStack);
}