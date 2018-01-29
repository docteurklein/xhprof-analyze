<?php declare(strict_types=1);

namespace DocteurKlein\ProfAnalyze;

use GraphAware\Neo4j\Client\Client;

final class GraphRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function id(string $id, int $threshold = 0): iterable
    {
        $result = $this->client->run(<<<CYPHER
            MATCH (caller:Function)-[stats:CALLS {run_id: {id}}]->(callee:Function)
            WHERE stats.wt > {threshold}
            WITH caller, stats, callee
            RETURN caller, stats, callee;
CYPHER
            , [
                'id' => $id,
                'threshold' => $threshold,
            ]
        );

        yield from $result->records();
    }

    public function compare(string $from, string $to, int $threshold = 0): iterable
    {
        $result = $this->client->run(<<<CYPHER
            MATCH
                (from_caller:Function)-[from_stats:CALLS {run_id: {from_id}}]->(from_callee:Function),
                (to_caller:Function {name: from_caller.name})-[to_stats:CALLS {run_id: {to_id}}]->(to_callee:Function {name: from_callee.name})
            WHERE to_stats.wt > {threshold}
            RETURN to_caller as caller, from_stats, to_stats, to_callee as callee;
CYPHER
            , [
                'from_id' => $from,
                'to_id' => $to,
                'threshold' => $threshold,
            ]
        );

        yield from $result->records();
    }
}
