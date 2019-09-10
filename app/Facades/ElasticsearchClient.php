<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see App\Providers\ElasticsearchServiceProvider
 */
class ElasticsearchClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'elasticsearch';
    }
}
