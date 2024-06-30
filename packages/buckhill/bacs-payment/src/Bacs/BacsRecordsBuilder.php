<?php

namespace Buckhill\BacsPayment\Bacs;

use Buckhill\BacsPayment\Bacs\Records\Hdr1Record;
use Buckhill\BacsPayment\Bacs\Records\VolRecord;

class BacsRecordsBuilder
{
    protected array $records = [];

    public function build(array $validatedData): array
    {
        $vol = new VolRecord($validatedData);
        $this->records['vol'] = $vol->buildRecord();

        // header 1 is depending on vol record, so we need to pass it to hdr1 record
        // it depends on owner id and serial number from vol record
        $hdr1 = new Hdr1Record($validatedData, $this->records['vol']);
        $this->records['hdr1'] = $hdr1->buildRecord();

        // ... add more records here

        return $this->records;
    }
}
