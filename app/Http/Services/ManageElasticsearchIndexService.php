<?php

namespace App\Http\Services;

use App\Exceptions\HousecomApiException;
use App\Exceptions\LaravelBaseApiException;
use ElasticsearchClient;

class ManageElasticsearchIndexService
{
    protected $elasicsearchClient;

    /**
     * __construct
     *
     * @param  mixed $elasicsearchClient
     *
     * @return void
     */
    public function __construct(ElasticsearchClient $elasicsearchClient)
    {
        $this->elasicsearchClient = $elasicsearchClient;
    }

    /**
     * Make indices
     *
     * @return Elasticsearch\Namespaces\IndicesNamespace
     */
    public function makeIndices()
    {
        return ElasticsearchClient::indices();
    }

    /**
     * Create the index with mappings and settings
     *
     * @param  string $indexName
     * @param  array $indexSettings
     * @param  array $mappingProperties
     * @param  boolean $enabledSource
     *
     * @return array
     */
    public function createIndex($model, $enabledSource = true) {
        $elasticSearchIndices = $this->makeIndices();

        $params = [
            'index' => $model->getIndexName(),
        ];

        if ($elasticSearchIndices->exists($params)) {
            return 1;
        }

        $indexSettings = $model->getIndexSettings();

        if (!is_null($indexSettings)) {
            $params['body']['settings'] = $indexSettings;
        }

        $mappingProperties = $this->getMappingProperties();

        if (!is_null($mappingProperties)) {
            $params['body']['mappings'] = [
                '_source' => [
                    'enabled' => $enabledSource,
                ],
                'properties' => $mappingProperties,
            ];
        }

        return $elasticSearchIndices->create($params);
    }

    public function deleteIndex($model)
    {
        $elasticSearchIndices = $this->makeIndices();

        $index = [
            'index' => $model->getIndexName(),
        ];

        return $elasticSearchIndices->delete($index);
    }

    public function putMappings($model)
    {
        // $params =
    }
}
