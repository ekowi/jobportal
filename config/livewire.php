<?php

return [
    'temporary_file_upload' => [
        'disk' => null,
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'bmp',
            'svg',
            'webp',
            'pdf',
        ],
        'rules' => null,
        'message' => null,
        'max_upload_time' => 5,
    ],
];
