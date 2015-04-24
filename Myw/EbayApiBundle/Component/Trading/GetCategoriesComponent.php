<?php
/**
 * Created by PhpStorm.
 * User: med
 * Date: 08/04/2015
 * Time: 00:06
 */

namespace Myw\EbayApiBundle\Component\Trading;

use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\SerializedName;
use Myw\EbayApiBundle\Component\EbayApiComponent;
use Myw\EbayApiBundle\Component\EbayApiInterface;
use Myw\EbayApiBundle\Component\Trading\EbayApiTradingComponent;

class GetCategoriesComponent extends EbayApiComponent implements EbayApiInterface{

    private $input;
    protected $siteId = 0; // US by default

    const URL_SANDBOX = 'https://api.sandbox.ebay.com/ws/api.dll';
    const URL_PRODUCT = 'https://api.ebay.com/ws/api.dll';
    const API_VERSION = 903;


    public function setApi($api){

    }

    public function setMethod($method){

    }

    public function setMode($mode){

    }


    public function getKeys(){

        parent::getKeys();
    }



    /**
     * @XmlList(inline = true, entry = "CategoryParent")
     */
    private $categoryParent;

    /**
     * @var string
     * @SerializedName("CategorySiteID")
     */
    private $categorySiteID;

    /**
     * @var integer
     * @SerializedName("LevelLimit")
     */
    private $levelLimit;

    /** @var boolean
     * @SerializedName("ViewAllNodes")
     */
    private $viewAllNodes;


    /**
     * @return array
     */
    public function getCategoryParent()
    {
        return $this->categoryParent;
    }

    /**
     * @param array $categoryParent
     * @return $this
     */
    public function setCategoryParent(array $categoryParent)
    {
        $this->categoryParent = $categoryParent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorySiteID()
    {
        return $this->categorySiteID;
    }

    /**
     * @param mixed $categorySiteID
     * @return $this
     */
    public function setCategorySiteID($categorySiteID)
    {
        $this->categorySiteID = $categorySiteID;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevelLimit()
    {
        return $this->levelLimit;
    }

    /**
     * @param int $levelLimit
     * @return $this
     */
    public function setLevelLimit($levelLimit)
    {
        $this->levelLimit = $levelLimit;

        return $this;
    }

    /**
     * @return bool
     */
    public function getViewAllNodes()
    {
        return $this->viewAllNodes;
    }

    /**
     * @param bool $viewAllNodes
     * @return $this
     */
    public function setViewAllNodes($viewAllNodes)
    {
        $this->viewAllNodes = $viewAllNodes;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setInput($value)
    {
        $this->input = $value;

        return $this;
    }

    public function getInput()
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function getRequestUrl()
    {
        if ($this->mode === self::MODE_PRODUCT) {
            return $this::URL_PRODUCT;
        } else {
            return $this::URL_SANDBOX;
        }
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return
            [
                'X-EBAY-API-CALL-NAME:' . $this->getMethod(),
                'X-EBAY-API-SITEID:' . $this->siteId,
                // Site 0 is for US
                'X-EBAY-API-APP-NAME:' . $this->keys['app_id'],
                'X-EBAY-API-DEV-NAME:' . $this->keys['dev_id'],
                'X-EBAY-API-CERT-NAME:' . $this->keys['cert_id'],
                'X-EBAY-API-COMPATIBILITY-LEVEL:' . self::API_VERSION,
                'X-EBAY-API-REQUEST-ENCODING:XML',
                // for a POST request, the response by default is in the same format as the request
                'Content-Type:text/xml;charset=utf-8',
            ];
    }


}