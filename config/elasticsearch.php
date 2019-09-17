<?php

return [
    'hosts' => [
        env('ELASTICSEARCH_HOST', 'elasticsearch:9200'),
    ],
    'retries' => env('ELASTICSEARCH_RETRIES', 1),
    'default_index' => 'default',
];
