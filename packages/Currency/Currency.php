<?php

namespace Packages\Currency;

class Currency
{
    public static function brl(string $value)
    {
        return 'R$ ' . number_format(floatval($value), 2, ',', '.');
    }

    public static function usd(string $value)
    {
        return '$' . number_format(floatval($value), 2, '.', ',');
    }
}