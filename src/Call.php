<?php declare(strict_types=1);

namespace DocteurKlein\ProfAnalyze;

final class Call
{
    private $caller;
    private $callee;
    private $stats;

    public function __construct($caller, $callee, Stats $stats)
    {
        $this->caller = $caller;
        $this->callee = $callee;
        $this->stats = $stats;
    }

    public function getCaller(): string
    {
        return $this->caller->name;
    }

    public function getCallee(): string
    {
        return $this->callee->name;
    }
}
