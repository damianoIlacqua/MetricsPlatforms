<?php

namespace Damians\MetricsPlatforms\Factory;

use Damians\MetricsPlatforms\Processor\GTMetrixPlatform;
use Damians\MetricsPlatforms\Processor\LighthousePlatform;
use Damians\MetricsPlatforms\Processor\PlatformInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProcessorFactory
{
    private static $platforms = [
       'gtmetrix' => GTMetrixPlatform::class,
       'lighthouse' => LighthousePlatform::class
    ];

    /**
     * @param $platformName
     * @return PlatformInterface
     * @throws \Exception
     */

    public static function getInstance($platformName, $options = []){

        foreach (ProcessorFactory::$platforms as $name => $platformClass){
            if($name == $platformName){
                return new $platformClass($options);
            }
        }

        throw new \Exception(sprintf('Platform "%s" not found. Possible platforms are: %s',
            $platformName,
            implode(', ',array_keys(ProcessorFactory::$platforms)))
        );
    }
}