<?php


namespace Damians\MetricsPlatforms\Processor;

use AppBundle\Entity\Lighthouse;
use Damians\MetricsPlatforms\Model\PlatformData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Process\Process;


class LighthousePlatform implements PlatformInterface
{

    public function __construct(array $options)
    {
    }

    public function run($url)
    {
        if(!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception(sprintf('"%s" is not a valid URL',$url));
        }

        $process = new Process('lighthouse https://www.motor1.com --chrome-flags="--headless" --output=json');
        $process->run();

        $lighthouse_output['test_url'] = $url;
        $lighthouse_output = json_decode($process->getOutput(), true);
        return PlatformData::fromArray($lighthouse_output);
    }

}