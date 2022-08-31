<?php
/*
    URL: https://www.codewars.com/kata/52685f7382004e774f0001f7
    Write a function, which takes a non-negative integer (seconds) as input and returns the time in a human-readable format (HH:MM:SS)

    HH = hours, padded to 2 digits, range: 00 - 99
    MM = minutes, padded to 2 digits, range: 00 - 59
    SS = seconds, padded to 2 digits, range: 00 - 59
    The maximum time never exceeds 359999 (99:59:59)

    You can find some examples in the test fixtures.
 */

/**
 * @param int $seconds
 * @return string
 */
function human_readable(int $seconds): string
{
    $hours = 0;
    $minutes = 0;

    for ($i = 0; ; $i++) {
        if (floor($seconds / 3600)) {
            $hours += 1;
            $seconds -= 3600;
        } else if (floor($seconds / 60)) {
            $minutes += 1;
            $seconds -= 60;
        } else {
            break;
        }
    }

    $hours = strlen($hours) == 1 ? '0' . $hours : strval($hours);
    $minutes = strlen($minutes) == 1 ? '0' . $minutes : strval($minutes);
    $seconds = strlen($seconds) == 1 ? '0' . $seconds : strval($seconds);

    return $hours . ':' . $minutes . ':' . $seconds;
}