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
    'mem.na' => 'format_cardinality',
    'mem.nf' => 'format_cardinality',
    'mem.aa' => 'format_bytes',
];

return new GraphRepository(ClientBuilder::create()->addConnection('bolt', getenv('NEO4J_URL'))->build());
