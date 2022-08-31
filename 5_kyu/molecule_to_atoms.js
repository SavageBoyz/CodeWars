/*
    URL: https://www.codewars.com/kata/52f831fa9d332c6591000511
    For a given chemical formula represented by a string, count the number of atoms of each element contained in the molecule and return an object (associative array in PHP, Dictionary<string, int> in C#, Map<String,Integer> in Java).

    For example:

    parse_molecule('H2O'); // => ['H' => 2, 'O' => 1]
    parse_molecule('Mg(OH)2'); // => ['Mg' => 1, 'O' => 2, 'H' => 2]
    parse_molecule('K4[ON(SO3)2]2'); // => ['K' => 4, 'O' => 14, 'N' => 2, 'S' => 4]
    As you can see, some formulas have brackets in them. The index outside the brackets tells you that you have to multiply count of each atom inside the bracket on this index. For example, in Fe(NO3)2 you have one iron atom, two nitrogen atoms and six oxygen atoms.

    Note that brackets may be round, square or curly and can also be nested. Index after the braces is optional.
*/

/**
 * @param {string} formula
 * @param {object} chemicalElem
 * @returns {string}
 */
function parseMolecule(formula, chemicalElem = {}) {
    const reChar = /([A-Z][a-z]*)/g;
    const reNum = /\d+/g;
    const reBracketsInsideParse = /([A-Z][a-z]*\d*)\d*/g;
    const deleteExcessSymbol = /(η\d*-)/g;

    if (formula.match(deleteExcessSymbol)) {
        excessSymbol = formula.match(deleteExcessSymbol);

        for (let i = 0; i < excessSymbol.length; i++) {
            formula = formula.replace(excessSymbol[i], "");
        }
    }

    if (formula.includes('(') || formula.includes('[') || formula.includes('{')) {
        let reBrackets = /\{.*\}\d*/g;
        let reNumAfterParent = /\}\d*/g;
        let secondNum = /\]\d+/g;
        let thirdNum = /\}\d+/g;

        if (formula.includes('(')) {
            reBrackets = /\([A-z 0-9]*\)*\d*/gi;
            reNumAfterParent = /\)\d*/g;
        } else if (formula.includes('[')) {
            reBrackets = /\[.*\]\d*/g;
            reNumAfterParent = /\]\d*/g;
        }

        let bracketsMatch = formula.match(reBrackets);

        for (let i = 0; i < bracketsMatch.length; i++) {
            let numAfterBracket = bracketsMatch[i].match(reNumAfterParent).map(x => x.replace(/[{(\[\])}]/g, ""));
            numAfterBracket = numAfterBracket[0] ? numAfterBracket[0] : 1;

            let numAfterBracketS = 1;
            let numAfterBracketT = 1;

            if (formula.includes('(')) {
                let reCheckFirst = /\[.*\]\d*/g;
                let checkFirst = formula.match(reCheckFirst);
                checkFirst = checkFirst ? checkFirst : [];

                for (let j = 0; j < checkFirst.length; j++) {
                    if (checkFirst[j].includes(bracketsMatch[i])) {
                        let temp = checkFirst[j].match(secondNum);
                        numAfterBracketS = temp ? temp[0].replace(/[{(\[\])}]/g, "") : 1;
                        break;
                    }
                }
            }

            if (formula.includes('[')) {
                let reCheckSecond = /\{.*\}\d*/g;
                let checkSecond = formula.match(reCheckSecond);
                checkSecond = checkSecond ? checkSecond : [];

                for (let j = 0; j < checkSecond.length; j++) {
                    if (checkSecond[j].includes(bracketsMatch[i])) {
                        let temp = checkSecond[j].match(thirdNum);
                        numAfterBracketT = temp ? temp[0].replace(/[{(\[\])}]/g, "") : 1;
                        break;
                    }
                }
            }

            bracketsMatch[i].match(reBracketsInsideParse).map(el => {
                let char = el.match(reChar);
                let num = el.match(reNum);

                if (chemicalElem.hasOwnProperty(char)) {
                    chemicalElem[char] += (num ? +num[0] : 1) * numAfterBracket * numAfterBracketS * numAfterBracketT;
                } else {
                    chemicalElem[char] = (num ? +num[0] : 1) * numAfterBracket * numAfterBracketS * numAfterBracketT;
                }
            });
            formula = formula.replace(bracketsMatch[i], '');
        }

        return parseMolecule(formula, chemicalElem);
    } else if (!formula) {
        return chemicalElem;
    } else {
        formula.match(reBracketsInsideParse).map(el => {
            let char = el.match(reChar);
            let num = el.match(reNum);

            if (chemicalElem.hasOwnProperty(char)) {
                chemicalElem[char] += num ? +num[0] : 1;
            } else {
                chemicalElem[char] = num ? +num[0] : 1;
            }
        });

        return chemicalElem;
    }
}