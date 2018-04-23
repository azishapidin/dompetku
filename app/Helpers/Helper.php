<?php

/**
 * Format amount with Currency Format.
 *
 * @param decimal $amount   Amount
 * @param string  $currency Currency
 * @param string  $position Currency symbol position
 *
 * @return string Formatted
 */
function currencyFormat($amount = 0, $currency = '', $position = 'before')
{
    $result = '';
    $currency = config('currency.'.$currency);
    if (is_null($currency)) {
        $currency = config('currency.'.config('account.default_currency'));
    }
    $symbol = $currency['symbol'];

    if ($position == 'before') {
        $result .= $symbol;
    }
    $result .= ' '.number_format(intval($amount), 2, ',', '.');
    if ($position == 'after') {
        $result .= $symbol;
    }

    return $result;
}
