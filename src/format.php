<?php

declare(strict_types=1);

function format_micro_seconds(int $duration, bool $withPlus = false)
{
    return format($duration, [
        'M' => ' s',
        'K' =>' ms',
        '_' => ' μs',
    ], $withPlus);
}

function format_bytes(int $bytes, bool $withPlus = false)
{
    return format($bytes, [
        'M' => ' MB',
        'K' =>' KB',
        '_' => ' B',
    ], $withPlus);
}

function format_cardinality(int $number, bool $withPlus = false)
{
    return format($number, [
        'M' => 'M',
        'K' => 'K',
        '_' => '',
    ], $withPlus);
}

function format(int $number, array $units, bool $withPlus = false)
{
    $plus = '';
    if ($withPlus && $number > 0) {
        $plus = '+';
    }
    if (abs($number) >= 1000000) {
        return sprintf('%s%.2f%s', $plus, $number / 1000000, $units['M']);
    }

    if (abs($number) >= 1000) {
        return sprintf('%s%.2f%s', $plus, $number / 1000, $units['K']);
    }

    return sprintf('%s%d%s', $plus, $number, $units['_']);
}
