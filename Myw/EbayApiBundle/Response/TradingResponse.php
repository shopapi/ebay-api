<?php
/**
 * Created by PhpStorm.
 * User: med
 * Date: 01/05/2015
 * Time: 00:19
 */

namespace Myw\EbayApiBundle\Response;

use JMS\Serializer\Annotation\XmlRoot;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;
/**
 * @XmlRoot("GetCategoriesResponse")
 */
class TradingResponse extends BaseResponse {

    /**
     * Last time logged in using ISO 8601 format.
     * @JMS\Type("string")
     * @JMS\XmlList(entry="timestamp")
     */

    protected $timestamp;

    /**
     * @JMS\Type("string")
     * @JMS\XmlList(entry="ack")
     */
    protected $ack;

    /**
     * @JMS\Type("string")
     * @JMS\XmlList(entry="build")
     */
    protected $build;

    /**
     * @JMS\Type("ArrayCollection<Myw\EbayApiBundle\Type\Category>")
     * @JMS\XmlList(entry="CategoryArray")
     */
    protected $categoryArray;

    public function __construct()
    {
        $this->categoryArray = new ArrayCollection();
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return string
     */
    public function getAck()
    {
        return $this->ack;
    }

    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @return array
     */
    public function getCategoryArray()
    {
        return $this->categoryArray;
    }

}