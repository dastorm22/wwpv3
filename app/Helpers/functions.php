<?php

define('DATE_FORMAT', 'm/d/Y');
define('DATETIME_FORMAT', 'm/d/Y h:i A');

/**
 * Transforms an html input name with brackets to the dot notation as parsed by the laravel request.
 * Example: address[line_1] => address.line_1.
 *
 * @param string $html
 * @return string
 */
function brackets_to_dots($html)
{
    $noRightBracket = str_replace(']', '', $html);
    $leftBracketToDot = str_replace('[', '.', $noRightBracket);
    $noRightDots = rtrim($leftBracketToDot, '.');

    return $noRightDots;
}

/**
 * Joins a string with a natural language conjunction at the end.
 * Example: a, b, c and d.
 *
 * @param array|Collection $list
 * @param string $conjunction
 * @return mixed|string
 */
function implode_natural_language($list, $conjunction = 'and')
{
    $array = $list instanceof \Illuminate\Support\Collection ? $list->all() : $list;

    $last = array_pop($array);

    if ($array) {
        return sprintf('%s %s %s', implode(', ', $array), $conjunction, $last);
    }

    return $last;
}

/**
 * Formats a number into 1,000.
 * @param int|float $amount
 * @return string
 */
function currency($amount)
{
    return number_format($amount, 0);
}

/**
 * Formats a number into 1,000.00.
 * @param int|float $amount
 * @return string
 */
function currency_with_cents($amount)
{
    return number_format($amount, 2);
}
