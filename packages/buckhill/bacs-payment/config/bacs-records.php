<?php

use Buckhill\BacsPayment\Bacs\Records\Hdr1Record;
use Buckhill\BacsPayment\Bacs\Records\VolRecord;

return [
    'schema' => [
        'vol' => [
            'class' => VolRecord::class,
            'length' => 80,
            'parts' => [
                'label_identifier' => [
                    'length' => 3,
                    'position' => '1:3',
                ],
                'label_number' => [
                    'length' => 1,
                    'position' => '4:4',
                ],
                'serial_number' => [
                    'length' => 6,
                    'position' => '5:10',
                ],
                'accessibility_indicator' => [
                    'length' => 1,
                    'position' => '11:11',
                ],
                'reserved_field_1' => [
                    'length' => 20,
                    'position' => '12:31',
                ],
                'reserved_field_2' => [
                    'length' => 6,
                    'position' => '32:37',
                ],
                'owner_id' => [
                    'length' => 14,
                    'position' => '38:51',
                ],
                'reserved_field' => [
                    'length' => 28,
                    'position' => '52:79',
                ],
                'label_standard_level' => [
                    'length' => 1,
                    'position' => '80:80',
                ],
            ],
        ],
        'hdr1' => [
            'class' => Hdr1Record::class,
            'length' => 80,
            'parts' => [
                'label_identifier' => [
                    'length' => 3,
                    'position' => '1:3',
                ],
                'label_number' => [
                    'length' => 1,
                    'position' => '4:4',
                ],
                'file_identifier' => [
                    'length' => 17,
                    'position' => '5:21',
                ],
                'set_identifier' => [
                    'length' => 6,
                    'position' => '22:27',
                ],
                'file_section_number' => [
                    'length' => 4,
                    'position' => '28:31',
                ],
                'file_sequence_number' => [
                    'length' => 4,
                    'position' => '32:35',
                ],
                'generation_number' => [
                    'length' => 4,
                    'position' => '36:39',
                ],
                'generation_version_number' => [
                    'length' => 2,
                    'position' => '40:41',
                ],
                'creation_date' => [
                    'length' => 6,
                    'position' => '42:47',
                ],
                'expiration_date' => [
                    'length' => 6,
                    'position' => '48:53',
                ],
                'accessibility_indicator' => [
                    'length' => 1,
                    'position' => '54:54',
                ],
                'block_count' => [
                    'length' => 6,
                    'position' => '55:60',
                ],
                'system_code' => [
                    'length' => 13,
                    'position' => '61:73',
                ],
                'reserved_field' => [
                    'length' => 7,
                    'position' => '74:80',
                ],
            ],
        ],
    ],
];
