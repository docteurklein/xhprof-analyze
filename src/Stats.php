<?php declare(strict_types=1);

namespace DocteurKlein\ProfAnalyze;

final class Stats
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    private function diff(self $other): self
    {
        return new Diff($this, $other);
    }
}
