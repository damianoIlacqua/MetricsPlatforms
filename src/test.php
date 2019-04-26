<?php

use Damians\MetricsPlatforms\Factory\ProcessorFactory;

include __DIR__.'/../vendor/autoload.php';

$url = 'http://www.google.com';

//$options['email'] =  "ginger.lindberg@motorsport.com";
$options['email'] =  "daniel.berglund@edimotive.com";
$options['api_key'] = "996ffd0eecc52e7813fd4614843dc496";

//$gt_instance = ProcessorFactory::getInstance('gtmetrix', $options);
$gt_instance = ProcessorFactory::getInstance('lighthouse');

$test_result = $gt_instance->run($url);
var_dump($test_result); die();
