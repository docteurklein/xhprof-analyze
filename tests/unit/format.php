<?php declare(strict_types=1);

assert(format_micro_seconds(-9871) == '-9.87 ms');
assert(format_micro_seconds(1) == '1 μs');
assert(format_micro_seconds(5656565, true) == '+5.66 s');
assert(format_bytes(-9871) == '-9.87 KB');
assert(format_bytes(1) == '1 B');
assert(format_bytes(5656565, true) == '+5.66 MB');
assert(format_cardinality(-9871) == '-9.87K');
assert(format_cardinality(1) == '1');
assert(format_cardinality(5656565, true) == '+5.66M');
echo 'ok';
