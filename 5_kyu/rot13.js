/*
    URL: https://www.codewars.com/kata/530e15517bc88ac656000716
    ROT13 is a simple letter substitution cipher that replaces a letter with the letter 13 letters after it in the alphabet. ROT13 is an example of the Caesar cipher.

    Create a function that takes a string and returns the string ciphered with Rot13. If there are numbers or special characters included in the string, they should be returned as they are. Only letters from the latin/english alphabet should be shifted, like in the original Rot13 "implementation".
 */

const lowerAlph = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
const upperCaseAlp = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
/**
 * @param {string} message
 * @returns {string}
 */
function rot13(message) {
    return message.split('').map(el => {
        let lowerIndex = lowerAlph.indexOf(el);
        let upperIndex = upperCaseAlp.indexOf(el);

        if (lowerIndex !== -1) {
            return el = lowerAlph[(lowerIndex + 13)] === undefined ? lowerAlph[(lowerIndex - 13)] : lowerAlph[(lowerIndex + 13)];
        } else if (upperIndex !== -1) {
            return el = upperCaseAlp[(upperIndex + 13)] === undefined ? upperCaseAlp[(upperIndex - 13)] : upperCaseAlp[(upperIndex + 13)];
        }

        return el;
    }).join('');
}