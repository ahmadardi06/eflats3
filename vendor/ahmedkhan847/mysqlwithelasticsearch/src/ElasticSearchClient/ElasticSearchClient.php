<?php
namespace ElasticSearchClient;

use Elasticsearch\ClientBuilder;

/**
 * Elasticsearch Client class
 */
class ElasticSearchClient
{
    private $index = null;
    private $type = null;

    /**
     * Set Index to Use in Elasticsearch.
     *
     * @param  string  $index
     * @void
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * Set Type to use in Elasticsearch
     *
     * @param  string  $type
     * @void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get Index to use in Elasticsearch.
     *
     * @return index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Get Type to use in Elasticsearch.
     *
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get Elasticsearch Client.
     *
     * @return ClientBuilder
     */
    public function getClient()
    {
        $hosts = [
            'elk.carsworld.co.id:9200'
        ];
        return ClientBuilder::create()->setHosts($hosts)->build();
    }
}
