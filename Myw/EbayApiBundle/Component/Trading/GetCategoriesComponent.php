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

class GetCategoriesComponent extends EbayApiComponent implements EbayApiInterface{

    protected $api;
    protected $method;
    protected $mode;

    public function setApi($api){

    }

    public function setMethod($method){

    }

    public function setMode($mode){

    }

    public function getKeys(){

        parent::getKeys();
    }

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
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
}