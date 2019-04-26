<?php

namespace Damians\MetricsPlatforms\Processor;

use Damians\MetricsPlatforms\Model\PlatformData;
use Doctrine\ORM\EntityManagerInterface;

interface PlatformInterface {

    public function __construct(array $options);

    /**
     * @param $url
     * @return PlatformData
     */
    public function run($url);

}