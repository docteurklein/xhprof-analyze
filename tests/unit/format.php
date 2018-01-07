<?php declare(strict_types=1);

namespace tests\unit;

final class format implements \Funk\Spec
{
    function it_format_microseconds()
    {
        expect(format_micro_seconds(-9871))->to->equal('-9.87 ms');
        expect(format_micro_seconds(1))->to->equal('1 μs');
        expect(format_micro_seconds(5656565, true))->to->equal('+5.66 s');
    }

    function it_format_bytes()
    {
        expect(format_bytes(-9871))->to->equal('-9.87 KB');
        expect(format_bytes(1))->to->equal('1 B');
        expect(format_bytes(5656565, true))->to->equal('+5.66 MB');
    }

    function it_format_cardinality()
    {
        expect(format_cardinality(-9871))->to->equal('-9.87K');
        expect(format_cardinality(1))->to->equal('1');
        expect(format_cardinality(5656565, true))->to->equal('+5.66M');
    }
}
