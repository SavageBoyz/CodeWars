<?php
/**
 *  URL: https://www.codewars.com/kata/5296bc77afba8baa690002d7
 *
 *  Write a function that will solve a 9x9 Sudoku puzzle. The function will take one argument consisting of the 2D puzzle array, with the value 0 representing an unknown square.
 *  The Sudokus tested against your function will be "easy" (i.e. determinable; there will be no need to assume and test possibilities on unknowns) and can be solved with a brute-force approach.
 *  For Sudoku rules, see the Wikipedia article.
 *
 *  sudoku([
 *  [5,3,0,0,7,0,0,0,0],
 *  [6,0,0,1,9,5,0,0,0],
 *  [0,9,8,0,0,0,0,6,0],
 *  [8,0,0,0,6,0,0,0,3],
 *  [4,0,0,8,0,3,0,0,1],
 *  [7,0,0,0,2,0,0,0,6],
 *  [0,6,0,0,0,0,2,8,0],
 *  [0,0,0,4,1,9,0,0,5],
 *  [0,0,0,0,8,0,0,7,9]
 *  ]); => [
 *  [5,3,4,6,7,8,9,1,2],
 *  [6,7,2,1,9,5,3,4,8],
 *  [1,9,8,3,4,2,5,6,7],
 *  [8,5,9,7,6,1,4,2,3],
 *  [4,2,6,8,5,3,7,9,1],
 *  [7,1,3,9,2,4,8,5,6],
 *  [9,6,1,5,3,7,2,8,4],
 *  [2,8,7,4,1,9,6,3,5],
 *  [3,4,5,2,8,6,1,7,9]
 *  ]
 */

/**
 * @param array $puzzle
 * @return array|null
 */
function sudoku(array $puzzle): ?array
{
    return recursive_fill_sudoku($puzzle);
}

/**
 * @param array $puzzle
 * @return array|null
 */
function recursive_fill_sudoku(array &$puzzle): ?array
{
    $matrix_info = get_matrix_info($puzzle);

    if ($matrix_info['has_zero_available_options']) {
        return null;
    }

    if ($matrix_info['is_completed']) {
        return $puzzle;
    }

    $next_val_set_info = $matrix_info['next_val_set_info'];

    for ($i = 0, $iMax = count($next_val_set_info['available_vals']); $i < $iMax; $i++) {
        $puzzle[$next_val_set_info['x']][$next_val_set_info['y']] = $next_val_set_info['available_vals'][$i];
        $next_set_result = recursive_fill_sudoku($puzzle);

        if ($next_set_result !== null) {
            return $puzzle;
        } else {
            $puzzle[$next_val_set_info['x']][$next_val_set_info['y']] = 0;
        }
    }

    return null;
}

/**
 * TODO: Требуется рефакторинг
 * @param array $puzzle
 * @return array
 */
function get_matrix_info(array $puzzle): array
{
    $result = [
        'available_values' => [],
        'next_val_set_info' => [],
        'has_zero_available_options' => FALSE,
        'is_completed' => FALSE
    ];

    $available_values = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    $non_available_rows_values = [];
    $non_available_cols_values = [];

    $non_available_matrix_vals = [
        [
            'range_x_start' => 0,
            'range_x_end' => 2,
            'range_y_start' => 0,
            'range_y_end' => 2,
            'vals' => []
        ],
        [
            'range_x_start' => 0,
            'range_x_end' => 2,
            'range_y_start' => 3,
            'range_y_end' => 5,
            'vals' => []
        ],
        [
            'range_x_start' => 0,
            'range_x_end' => 2,
            'range_y_start' => 6,
            'range_y_end' => 8,
            'vals' => []
        ],
        [
            'range_x_start' => 3,
            'range_x_end' => 5,
            'range_y_start' => 0,
            'range_y_end' => 2,
            'vals' => []
        ],
        [
            'range_x_start' => 3,
            'range_x_end' => 5,
            'range_y_start' => 3,
            'range_y_end' => 5,
            'vals' => []
        ],
        [
            'range_x_start' => 3,
            'range_x_end' => 5,
            'range_y_start' => 6,
            'range_y_end' => 8,
            'vals' => []
        ],
        [
            'range_x_start' => 6,
            'range_x_end' => 8,
            'range_y_start' => 0,
            'range_y_end' => 2,
            'vals' => []
        ],
        [
            'range_x_start' => 6,
            'range_x_end' => 8,
            'range_y_start' => 3,
            'range_y_end' => 5,
            'vals' => []
        ],
        [
            'range_x_start' => 6,
            'range_x_end' => 8,
            'range_y_start' => 6,
            'range_y_end' => 8,
            'vals' => []
        ],
    ];

    foreach ($puzzle as $row_ind => $row) {
        foreach ($row as $col_ind => $value) {
            if ($value !== 0) {
                $non_available_rows_values[$row_ind][] = $value;
                $non_available_cols_values[$col_ind][] = $value;

                foreach ($non_available_matrix_vals as $ind_temp => $temp) {
                    if ($row_ind >= $temp['range_x_start'] &&
                        $row_ind <= $temp['range_x_end'] &&
                        $col_ind >= $temp['range_y_start'] &&
                        $col_ind <= $temp['range_y_end']) {
                        $non_available_matrix_vals[$ind_temp]['vals'][] = $value;
                        break;
                    }
                }
            } else {
                $result['available_values'][$row_ind][$col_ind][] = [];
            }
        }
    }

    if (!empty($result['available_values'])) {
        foreach ($result['available_values'] as $row_ind => $row) {
            foreach ($row as $col_ind => $value) {
                $result['available_values'][$row_ind][$col_ind] = [];

                foreach ($available_values as $val) {
                    foreach ($non_available_matrix_vals as $ind_temp => $temp) {
                        if ($row_ind >= $temp['range_x_start'] &&
                            $row_ind <= $temp['range_x_end'] &&
                            $col_ind >= $temp['range_y_start'] &&
                            $col_ind <= $temp['range_y_end']) {
                            $TEMP_FOR_CHECK = $non_available_matrix_vals[$ind_temp]['vals'];
                            break;
                        }
                    }

                    if ((!isset($non_available_rows_values[(int)$row_ind]) || !in_array($val, $non_available_rows_values[(int)$row_ind])) &&
                        (!isset($non_available_cols_values[(int)$col_ind]) || !in_array($val, $non_available_cols_values[(int)$col_ind])) &&
                        !in_array($val, $TEMP_FOR_CHECK)) {
                        $result['available_values'][$row_ind][$col_ind][] = $val;
                    }
                }

                if (empty($result['available_values'][$row_ind][$col_ind])) {
                    $result['has_zero_available_options'] = TRUE;
                } else {
                    if (empty($result['next_val_set_info']) || count($result['available_values'][$row_ind][$col_ind]) < count($result['next_val_set_info']['available_vals'])) {
                        $result['next_val_set_info'] = [
                            'x' => $row_ind,
                            'y' => $col_ind,
                            'available_vals' => $result['available_values'][$row_ind][$col_ind]
                        ];
                    }
                }

            }
        }
    } else {
        $result['is_completed'] = TRUE;
    }

    return $result;
}