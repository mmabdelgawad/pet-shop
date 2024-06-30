<?php

use Buckhill\BacsPayment\Bacs\Records\VolRecord;

beforeEach(function () {
    $this->validatedData = [
        'vol' => [
            'owner_id' => 'BACS',
            'owner_id_no' => '22',
        ],
    ];
});

test('vol record parts length', function () {
    $volConfigParts = config('bacs.schema.vol.parts');

    $vol = new VolRecord($this->validatedData);

    expect(strlen($vol->getLabelIdentifier()))->toBe($volConfigParts['label_identifier']['length'])
        ->and(strlen($vol->getLabelNumber()))->toBe($volConfigParts['label_number']['length'])
        ->and(strlen($vol->getSerialNumber()))->toBe($volConfigParts['serial_number']['length'])
        ->and(strlen($vol->getAccessibilityIndicator()))->toBe($volConfigParts['accessibility_indicator']['length'])
        ->and(strlen($vol->getReservedField1()))->toBe($volConfigParts['reserved_field_1']['length'])
        ->and(strlen($vol->getReservedField2()))->toBe($volConfigParts['reserved_field_2']['length'])
        ->and(strlen($vol->getOwnerId()))->toBe($volConfigParts['owner_id']['length'])
        ->and(strlen($vol->getReservedField()))->toBe($volConfigParts['reserved_field']['length'])
        ->and(strlen($vol->getLabelStandardLevel()))->toBe($volConfigParts['label_standard_level']['length']);
});

test('vol record length', function () {
    $volConfig = config('bacs.schema.vol');

    $vol = new VolRecord($this->validatedData);

    expect(strlen($vol->buildRecord()))->toBe($volConfig['length']);
});

test('owner id logic with multiple inputs', function ($requestData, $expectedOwnerId) {
    $vol = new VolRecord([
        'vol' => [
            'owner_id' => $requestData,
            'owner_id_no' => '22',
        ],
    ]);

    expect($vol->getOwnerId())->toEqual($expectedOwnerId);
})->with([
    ['BACS', '    BACS22    '],
    ['HSBC', '    HSBC      '],
    ['SAGE', '    SAGE      '],
]);
