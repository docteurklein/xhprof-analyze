<?php declare(strict_types=1);

namespace DocteurKlein\ProfAnalyze;

final class Diff
{
    private $from;

    private $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function __get($key): array
    {
        $diff = $this->to->$key - $this->from->$key;
        $ratio = $this->to->$key / $this->from->$key;

        return [$diff, format_micro_seconds($diff, true), $ratio];
    }
}
