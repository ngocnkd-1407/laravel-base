<?php

namespace App\Http\Services;

use App\Exceptions\HousecomApiException;
use App\Exceptions\LaravelBaseApiException;
use ElasticsearchClient;

class ManageElasticsearchIndexService
{
    protected $elasicsearchIndices;

    /**
     * ManageElasticsearchIndexService constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->elasicsearchIndices = ElasticsearchClient::indices();
    }

    /**
     * Create the index with mappings and settings
     *
     * @param  string $indexName
     * @param  array $indexSettings
     * @param  array $mappingProperties
     * @param  boolean $enabledSource
     *
     * @return array|boolean
     */
    public function createIndex($model, $enabledSource = true)
    {
        $params = [
            'index' => $model->getIndexName(),
        ];

        if ($this->elasicsearchIndices->exists($params)) {
            return false;
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

        return $this->elasicsearchIndices->create($params);
    }

    /**
     * Delete an index
     *
     * @param  mixed $model
     *
     * @return array
     */
    public function deleteIndex($model)
    {
        $index = [
            'index' => $model->getIndexName(),
        ];

        return $this->elasicsearchIndices->delete($index);
    }

    /**
     * putMapping
     *
     * @param  mixed $model
     * @param  boolean $enabledSource
     *
     * @return array
     */
    public function putMapping($model, $enabledSource = true)
    {
        $params = [
            'index' => $model->getIndexName(),
        ];

        $mappingProperties = $this->getMappingProperties();

        if (!is_null($mappingProperties)) {
            $params['body'] = [
                '_source' => [
                    'enabled' => $enabledSource,
                ],
                'properties' => $mappingProperties,
            ];
        }

        return $this->elasicsearchIndices->putMapping($params);
    }
}
