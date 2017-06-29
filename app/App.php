<?php

require "Percolator.php";

/**
 * Class App
 *
 * @property \Elasticsearch\Client $client
 */
class App {

    public function execute($argv) {
        if(!is_array($argv) || count($argv) <= 1) {
            exit("no target class was provided\n");
        }


        $instance = new $argv[1]();

        if(count($argv) >= 3) {;
            $instance->setting();
            return $instance->$argv[2]();
        }

        $instance->init();
    }

}