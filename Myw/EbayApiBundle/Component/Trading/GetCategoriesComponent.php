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
use JMS\Serializer\Annotation\Expose;

use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;
use Myw\EbayApiBundle\Type\RequesterCredentials;

/**
 * @XmlNamespace(uri="urn:ebay:apis:eBLBaseComponents")
 * @XmlRoot("GetCategoriesRequest")
 * @ExclusionPolicy(value="none")
 */
class GetCategoriesComponent extends EbayApiTradingComponent implements EbayApiInterface{

    const URL_SANDBOX = 'https://api.sandbox.ebay.com/ws/api.dll';
    const URL_PRODUCT = 'https://api.ebay.com/ws/api.dll';


    /**
     * @Expose
     * @var string
     * @SerializedName("CategorySiteID")
     */
    private $categorySiteID;

    /**
     * @Expose
     * @var integer
     * @SerializedName("LevelLimit")
     */
    private $levelLimit;

    /** @var boolean
     * @SerializedName("ViewAllNodes")
     */
    private $viewAllNodes;


    /**
     * @Expose
     * @XmlList(entry = "CategoryParent")
     * @SerializedName("CategoryParent")
     */
    private $categoryParent;

    /**
     * @Expose
     * @XmlList(entry = "DetailLevel")
     * @SerializedName("DetailLevel")
     */
    protected $detailLevel;

    /**
     * @return array
     */
    public function getDetailLevel()
    {
        return $this->detailLevel;
    }

    /**
     * @param integer $detailLevel
     * @return $this
     */
    public function setDetailLevel($detailLevel)
    {
        $this->detailLevel = $detailLevel;

        return $this;
    }

    /**
     * @return array
     */
    public function getCategoryParent()
    {
        return $this->categoryParent;
    }

    /**
     * @param int $categoryParent
     * @return $this
     */
    public function setCategoryParent($categoryParent)
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

}