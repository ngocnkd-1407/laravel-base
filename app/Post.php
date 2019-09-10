<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'tags'];

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
