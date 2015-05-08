<?php
/**
 * Created by PhpStorm.
 * User: med
 * Date: 01/05/2015
 * Time: 00:29
 */

namespace Myw\EbayApiBundle\Type;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

class Category {

    /**
     * @JMS\Type("string")
     * @JMS\XmlList(entry="BestOfferEnabled")
     */
    protected $bestOfferEnabled;

    /**
     * @JMS\Type("string")
     * @JMS\XmlList(entry="AutoPayEnabled")
     */
    protected $autoPayEnabled;

    /**
     * @JMS\Type("integer")
     * @JMS\XmlList(entry="CategoryID")
     */
    protected $CategoryID;

    /**
     * @JMS\Type("integer")
     * @JMS\XmlList(entry="CategoryLevel")
     */
    protected $CategoryLevel;

    /**
     * @JMS\Type("string")
     * @JMS\XmlList(entry="CategoryName")
     */
    protected $CategoryName;

    /**
     * @JMS\Type("integer")
     * @JMS\XmlList(entry="CategoryParentID")
     */
    protected $CategoryParentID;

    /**
     * @JMS\Type("string")
     * @JMS\XmlList(entry="LeafCategory")
     */
    protected $LeafCategory;

}