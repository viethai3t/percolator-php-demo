<?php

use Elasticsearch\ClientBuilder;

/**
 * Class BaseElastic
 *
 * @property \Elasticsearch\Client $client
 */
abstract class BaseElastic {

    public function init() {
        $this->setting();
        $this->createIndex();
        $this->createData();
    }

    public function setting() {
        $this->client = ClientBuilder::create()
            ->setHosts($this->getHosts())
            ->build();
    }

    private function getHosts() {
        return [
            '127.0.0.1:9200', // Domain + Port
            '127.0.0.1',     // Just Domain
        ];
    }

    abstract public function createIndex();
    abstract public function createData();
    abstract public function search();

}