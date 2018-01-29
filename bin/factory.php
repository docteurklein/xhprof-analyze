<?php declare(strict_types=1);

namespace DocteurKlein\ProfAnalyze;

set_error_handler(function($no, $str, $file, $line) {
    throw new \ErrorException($str, $no, 1, $file, $line);
});

require(__DIR__.'/../vendor/autoload.php');

use GraphAware\Neo4j\Client\ClientBuilder;
use DocteurKlein\ProfAnalyze\GraphRepository;

const map = [
    'cpu' => 'format_micro_seconds',
    'wt' => 'format_micro_seconds',
    'ct' => 'format_cardinality',
    'mu' => 'format_bytes',
    'pmu' => 'format_bytes',
    'memory_size' => 'format_bytes',
    'memory_size_inclusive' => 'format_bytes',
    'blocks_count' => 'format_cardinality',
    'blocks_count_inclusive' => 'format_cardinality',
    'calls' => 'format_cardinality',
];

return new GraphRepository(ClientBuilder::create()->addConnection('bolt', getenv('NEO4J_URL'))->build());
