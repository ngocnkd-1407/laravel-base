<?php

namespace App\Traits;

use App\Facades\ElasticsearchClient;
use App\Exceptions\LaravelBaseApiException;

trait ElasticsearchTrait
{
    /**
     * getIndexName
     *
     * @return string
     */
    public function getIndexName()
    {
        return !is_null($this->indexName) ? $this->indexName : config('elasticsearch.default_index');
    }

    /**
     * getIndexSettings
     *
     * @return array
     */
    public function getIndexSettings()
    {
        return $this->indexSettings;
    }

    /**
     * getMappingProperties
     *
     * @return array
     */
    public function getMappingProperties()
    {
        return $this->mappingProperties;
    }

    /**
     * setMappingProperties
     *
     * @param  array $mapping
     *
     * @return void
     */
    public function setMappingProperties(array $mapping = null)
    {
        $this->mappingProperties = $mapping;
    }

    /**
     * addToIndex
     *
     * @return void
     */
    public function addToIndex()
    {
        if (!$this->exists) {
            throw new LaravelBaseApiException('elastic_document_not_exists');
        }

        $params = $this->getBaseParams();
        $params['body'] = $this->toArray();

        return ElasticsearchClient::index($params);
    }

    /**
     * Index all documents in an Eloquent model.
     *
     * @return array
     */
    public static function addAllToIndex()
    {
        $instance = new static;

        $all = $instance->newQuery()->get(['*']);

        return $all->addToIndex();
    }

    /**
     * Retrieve an ElasticSearch document for this entity.
     *
     * @return array
     */
    public function getIndexedDocument()
    {
        $params = $this->getBaseParams();

        return ElasticsearchClient::get($params);
    }

    /**
     * Partial Update to Indexed Document
     *
     * @return array
     */
    public function updateIndex()
    {
        $params = $this->getBaseParams();

        // Get our document body data.
        $params['body']['doc'] = $this->toArray();

        return ElasticsearchClient::update($params);
    }

    /**
     * Delete documents
     *
     * @return array
     */
    public function deleteDocument()
    {
        return ElasticsearchClient::delete($this->getBaseParams());
    }

    /**
     * Get base params
     *
     * @return array
     */
    protected function getBaseParams()
    {
        return [
            'index' => $this->getIndexName(),
            'id' => $this->getKey(),
        ];
    }
}
