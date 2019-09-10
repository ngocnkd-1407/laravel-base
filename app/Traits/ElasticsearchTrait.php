<?php

namespace App\Traits;

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
}
