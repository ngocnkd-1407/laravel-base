<?php

namespace App;

use App\Traits\ElasticsearchTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ElasticsearchTrait;

    protected $fillable = [
        'title',
        'body',
        'tags',
    ];

    protected $mappingProperties = [
        'title' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
        'body' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
        'tags' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
    ];
}
