<?php


namespace Damians\MetricsPlatforms\Processor;

use Doctrine\ORM\EntityManagerInterface;
use Entrecore\GTMetrixClient\GTMetrixClient;
use Entrecore\GTMetrixClient\GTMetrixTest;
use Damians\MetricsPlatforms\Model\PlatformData;


class GTMetrixPlatform implements PlatformInterface
{

    /**
     * @var string
     */
    private $gtmetrix_email;

    /**
     * @var string
     */
    private $gtmetrix_api_key;


    public function __construct(array $options)
    {
        $this->gtmetrix_email = $options['email'];
        $this->gtmetrix_api_key = $options['api_key'];
    }
    /**
     * @param $url
     * @return PlatformData
     * @throws \Entrecore\GTMetrixClient\GTMetrixConfigurationException
     * @throws \Entrecore\GTMetrixClient\GTMetrixException
     */
    public function run($url)
    {
        if(!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception(sprintf('"%s" is not a valid URL',$url));
        }

        $client = new GTMetrixClient();

        $client->setUsername($this->gtmetrix_email);
        $client->setAPIKey($this->gtmetrix_api_key);

        $client->getLocations();
        $client->getBrowsers();

        /** @var \Entrecore\GTMetrixClient\GTMetrixTest $test */
        $test = $client->startTest($url);

        //Wait for result
        while ($test->getState() != GTMetrixTest::STATE_COMPLETED &&
            $test->getState() != GTMetrixTest::STATE_ERROR) {
            $client->getTestStatus($test);
            sleep(2);
        }

        $output = [];
        $output['test_url'] = $url;
        foreach (get_class_methods($test) as $method){
            if(substr($method,0,3) == 'get'){
                $output[substr($method,3)] = $test->$method();
            }
        }

        return PlatformData::fromArray($output);
    }

}