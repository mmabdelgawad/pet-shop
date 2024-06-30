<?php

test('vol and hdr1 records are returned', function () {
    $this->post('/api/bacs', [
        'vol' => [
            'owner_id' => 'HSBC',
        ],
        'hdr1' => [
            'file_creation_date' => '06/29/2024',
            'file_expiration_date' => '07/29/2024',
        ],
    ])
        ->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'data' => [
                'vol',
                'hdr1',
            ],
        ]);
});
