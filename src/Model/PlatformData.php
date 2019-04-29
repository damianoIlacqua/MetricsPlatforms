<?php


namespace Damians\MetricsPlatforms\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a LabLog item, either a BlogPost or an Event.
 * It is abstract because we never have a LabLog entity, it's either an event or a blog post.
 * @ORM\Entity
 * @ORM\Table(name="platform_data")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap( {"gt_metrix" = "GTMetrix", "lighthouse" = "Lighthouse"} )
 */
class PlatformData
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\Column(type="string")
     */
    protected $test_url;

    /**
     * @ORM\Column(type="text")
     */
    protected $full_data_json;

    protected $data;

    public static function fromArray(array $value){
        $pd = new self();
        $pd->setData($value);
        $pd->setDate(new \DateTime());
        $pd->setTestUrl($value['test_url']);
        $pd->setFullDataJson(json_encode($value));
        return $pd;
    }

    public function toArray(){
        return $this->data;
    }


    /***** Getters and setters *****/

    public function getId()
    {
        return $this->id;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getTestUrl()
    {
        return $this->test_url;
    }

    /**
     * @param mixed $test_url
     */
    public function setTestUrl($test_url)
    {
        $this->test_url = $test_url;
    }

    /**
     * @return mixed
     */
    public function getHtmlBytes()
    {
        return $this->html_bytes;
    }

    /**
     * @param mixed $html_bytes
     */
    public function setHtmlBytes($html_bytes)
    {
        $this->html_bytes = $html_bytes;
    }

    /**
     * @return mixed
     */
    public function getPageBytes()
    {
        return $this->page_bytes;
    }

    /**
     * @param mixed $page_bytes
     */
    public function setPageBytes($page_bytes)
    {
        $this->page_bytes = $page_bytes;
    }

    /**
     * @return mixed
     */
    public function getDomContentLoadedTime()
    {
        return $this->dom_content_loaded_time;
    }

    /**
     * @param mixed $dom_content_loaded_time
     */
    public function setDomContentLoadedTime($dom_content_loaded_time)
    {
        $this->dom_content_loaded_time = $dom_content_loaded_time;
    }

    /**
     * @return mixed
     */
    public function getOnloadTime()
    {
        return $this->onload_time;
    }

    /**
     * @param mixed $onload_time
     */
    public function setOnloadTime($onload_time)
    {
        $this->onload_time = $onload_time;
    }

    /**
     * @return mixed
     */
    public function getFullDataJson()
    {
        return $this->full_data_json;
    }

    /**
     * @param mixed $full_data_json
     */
    public function setFullDataJson($full_data_json)
    {
        $this->full_data_json = $full_data_json;
    }

}