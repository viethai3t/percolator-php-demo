<?php

require 'BaseElastic.php';

class Percolator extends BaseElastic {

    const INDEX_NAME = "percolator-php";

    public function createIndex() {
        $params = [
            "index" => self::INDEX_NAME,
            "body" => [
                "mappings" => [
                    "news" => [
                        "properties" => [
                            "title" => ["type" => "text"],
                            "contents" => ["type" => "text"]
                        ]
                    ],
                    "economy" => [
                        "properties" => [
                            "query" => ["type" => "percolator"]
                        ]
                    ],
                    "tree" => [
                        "properties" => [
                            "query" => ["type" => "percolator"]
                        ]
                    ]
                ]
            ]
        ];
        return $this->client->indices()->create($params);
    }

    public function createData() {
        //economy
        $params = [
            'index' => self::INDEX_NAME,
            'type' => 'economy',
            'id' => '1',
            'body' => [
                "query" => [
                    "bool"=> ["should" => [
                        [
                            "match" => ["title" => [
                                "query" => "時事通信 株式 東京 外為 株",
                                "operator" => "or",
                                "minimum_should_match"=> "2%"
                            ]]
                        ],
                        [
                            "match"=> ["contents"=> [
                                    "query"=> "市場 株式 株価 指数 日経",
                                    "operator"=> "or",
                                    "minimum_should_match"=> "2%"
                                ]
                            ]
                        ]
                    ]]
                ]
            ]
        ];
        $this->client->index($params);
    }

    public function search() {
        $params = [
            'index' => self::INDEX_NAME,
            'body' => [
                'query' => [
                    "percolate" => [
                        "field" => "query",
                        "document_type" => "news",
                        "document" => [
                            "title" => "飲食料品、消費税負担を軽減…１０％後に給付株式",
                            "contents" => ""
                        ]
                    ]
                ]
            ]
        ];
        $results = $this->client->search($params);
        var_dump($results);
    }

    public function delete() {
        $params = ['index' => self::INDEX_NAME];
        if($this->client) {
            return $this->client->indices()->delete($params);
        }
    }


}