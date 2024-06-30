<?php

namespace Buckhill\BacsPayment\Bacs;

abstract class MessageRecord
{
    protected function extractPart(string $record, int $start, int $end): string
    {
        return substr($record, $start - 1, $end - $start + 1);
    }

    abstract public function buildRecord(): string;
}
