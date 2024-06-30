<?php

use Buckhill\BacsPayment\Bacs\Records\Hdr1Record;
use Buckhill\BacsPayment\Bacs\Records\VolRecord;

beforeEach(function () {
    $this->validatedData = [
        'vol' => [
            'owner_id' => 'SAGE',
        ],
        'hdr1' => [
            'file_creation_date' => '06/29/2024',
            'file_expiration_date' => '07/29/2024',
        ],
    ];

    $this->volRecord = (new VolRecord($this->validatedData))->buildRecord();
});

test('hdr1 record parts length', function () {
    $hdr1ConfigParts = config('bacs.schema.hdr1.parts');

    $hdr1 = new Hdr1Record($this->validatedData, $this->volRecord);

    expect(strlen($hdr1->getLabelIdentifier()))->toBe($hdr1ConfigParts['label_identifier']['length'])
        ->and(strlen($hdr1->getLabelNumber()))->toBe($hdr1ConfigParts['label_number']['length'])
        ->and(strlen($hdr1->getFileIdentifier()))->toBe($hdr1ConfigParts['file_identifier']['length'])
        ->and(strlen($hdr1->getSetIdentifier()))->toBe($hdr1ConfigParts['set_identifier']['length'])
        ->and(strlen($hdr1->getFileSectionNumber()))->toBe($hdr1ConfigParts['file_section_number']['length'])
        ->and(strlen($hdr1->getFileSequenceNumber()))->toBe($hdr1ConfigParts['file_sequence_number']['length'])
        ->and(strlen($hdr1->getGenerationNumber()))->toBe($hdr1ConfigParts['generation_number']['length'])
        ->and(strlen($hdr1->getGenerationVersionNumber()))->toBe($hdr1ConfigParts['generation_version_number']['length'])
        ->and(strlen($hdr1->getCreationDate()))->toBe($hdr1ConfigParts['creation_date']['length'])
        ->and(strlen($hdr1->getExpirationDate()))->toBe($hdr1ConfigParts['expiration_date']['length'])
        ->and(strlen($hdr1->getAccessibilityIndicator()))->toBe($hdr1ConfigParts['accessibility_indicator']['length'])
        ->and(strlen($hdr1->getBlockCount()))->toBe($hdr1ConfigParts['block_count']['length'])
        ->and(strlen($hdr1->getSystemCode()))->toBe($hdr1ConfigParts['system_code']['length'])
        ->and(strlen($hdr1->getReservedField()))->toBe($hdr1ConfigParts['reserved_field']['length']);
});

test('hdr1 record length', function () {
    $hdr1Config = config('bacs.schema.hdr1');

    $hdr1 = new Hdr1Record($this->validatedData, $this->volRecord);

    expect(strlen($hdr1->buildRecord()))->toBe($hdr1Config['length']);
});

test('creation date is converted to YYDDDD correctly', function ($creationDate, $expectedCreationDate) {
    $hdr1 = new Hdr1Record([
        'vol' => [
            'owner_id' => 'SAGE',
        ],
        'hdr1' => [
            'file_creation_date' => $creationDate,
            'file_expiration_date' => '06/29/2025',
        ],
    ], $this->volRecord);

    expect($hdr1->getCreationDate())->toBe($expectedCreationDate);
})->with([
    ['07/15/2023', ' 23196'],
    ['06/29/2024', ' 24181'],
    ['01/01/2025', ' 25001'],
]);

test('expiration date is converted to YYDDDD correctly', function ($expirationDate, $expectedExpirationDate) {
    $hdr1 = new Hdr1Record([
        'vol' => [
            'owner_id' => 'SAGE',
        ],
        'hdr1' => [
            'file_creation_date' => '06/29/2024',
            'file_expiration_date' => $expirationDate,
        ],
    ], $this->volRecord);

    expect($hdr1->getExpirationDate())->toBe($expectedExpirationDate);
})->with([
    ['07/15/2024', ' 24197'],
    ['06/29/2024', ' 24181'],
]);
