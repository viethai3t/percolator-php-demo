<?php

require 'vendor/autoload.php';
require 'app/App.php';

$elastic = new App();
$elastic->execute($argv);