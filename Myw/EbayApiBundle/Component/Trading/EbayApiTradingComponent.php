<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m.benhenda
 * Date: 07/04/15
 * Time: 16:54
 * To change this template use File | Settings | File Templates.
 */

namespace Myw\EbayApiBundle\Component\Trading;

use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Myw\EbayApiBundle\Type\RequesterCredentials;

/**
 * @XmlNamespace(uri="urn:ebay:apis:eBLBaseComponents")
 * @ExclusionPolicy(value="all")
 */
class EbayApiTradingComponent
{

    const URL_SANDBOX    = 'https://api.sandbox.ebay.com/ws/api.dll';
    const URL_PRODUCT    = 'https://api.ebay.com/ws/api.dll';
    const API_VERSION    = 919;
    const MODE_PRODUCT   = 1;
    const WARNING_LEVEL  = "Low";

    /**
     * @Expose
     * @XmlList(entry = "version")
     */
    protected $version;

    protected $xmlRequest;
    /**
     * @Exclude
     */
    protected $siteId = 0; // US by default

    /**
     * @Exclude
     */
    protected $mode = 1;

    /**
     * @Exclude
     */
    protected $method;

    /**
     * @Exclude
     */
    protected $parameters;

    /**
     * @Exclude
     */
    protected $keys;

    /**
     * @var string
     * @Expose
     * @SerializedName("ErrorLanguage")
     */
    protected $errorLanguage;

    /**
     * @Expose
     * @SerializedName("MessageID")
     */
    protected $messageID;

    /**
     * @Expose
     * @XmlList(inline = true, entry = "OutputSelector")
     */
    protected $outputSelector;

    /**
     * @var string
     * @Expose
     * @SerializedName("WarningLevel")
     */
    protected $warningLevel;

    /**
     * @Expose
     * @Type("Myw\EbayApiBundle\Type\RequesterCredentials")
     * @SerializedName("RequesterCredentials")
     */
    protected $requesterCredentials;

    public function __construct($parameters, $mode, $method){
        $this->setMode($mode);
        $this->setParameters($parameters);
        $this->setMethod($method);
    }

    public function setMode($mode){
        $this->mode = $mode;

        return $this;
    }

    public function getMode(){
        return $this->mode;
    }

    public function setParameters($parameters){
        $this->parameters = $parameters;

        if ($this->getMode() == 0) {
            //sandbox
            $this->keys['app_name'] = $parameters['sandbox']['app_name'];
            $this->keys['dev_name'] = $parameters['sandbox']['dev_id'];
            $this->keys['cert_name'] = $parameters['sandbox']['cert_name'];
        }else {
            $this->keys['app_name'] = $parameters['production']['app_name'];
            $this->keys['dev_name'] = $parameters['production']['dev_id'];
            $this->keys['cert_name'] = $parameters['production']['cert_name'];
        }

        return $this;
    }

    public function getParameters(){
        return $this->parameters;
    }

    public function setMethod($method){
        $this->method = $method;

        return $this;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getKeys(){
        return $this->keys;
    }

    /**
     * @return string
     */
    public function getErrorLanguage(){
        return $this->errorLanguage;
    }

    /**
     * @param string $errorLanguage
     * @return $this
     */
    public function setErrorLanguage($errorLanguage){
        $this->errorLanguage = $errorLanguage;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageID(){
        return $this->messageID;
    }

    /**
     * @param string $messageID
     * @return $this
     */
    public function setMessageID($messageID){
        $this->messageID = $messageID;

        return $this;
    }

    /**
     * @return array
     */
    public function getOutputSelector(){
        return $this->outputSelector;
    }

    /**
     * @param array $outputSelector
     * @return $this
     */
    public function setOutputSelector($outputSelector){
        $this->outputSelector = $outputSelector;

        return $this;
    }

    /**
     * @return string
     */
    public function getWarningLevel(){
        return $this->warningLevel;
    }

    /**
     * @param string $warningLevel
     * @return $this
     */
    public function setWarningLevel($warningLevel){
        $this->warningLevel = $warningLevel;

        return $this;
    }

    /**
     * @return RequesterCredentials
     */
    public function getRequesterCredentials(){
        return $this->requesterCredentials;
    }

    /**
     * @param RequesterCredentials $requesterCredentials
     * @return $this
     */
    public function setRequesterCredentials(
        RequesterCredentials $requesterCredentials
    ){
        $this->requesterCredentials = $requesterCredentials;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setXmlRequest($value){
        $this->xmlRequest = $value;

        return $this;
    }

    /**
     * @return XML
     */
    public function getXmlRequest(){
        return $this->xmlRequest;
    }

    /**
     * @return string
     */
    public function getRequestUrl(){
        if ($this->mode === self::MODE_PRODUCT) {
            return $this::URL_PRODUCT;
        }else {
            return $this::URL_SANDBOX;
        }
    }

    /**
     * @return array
     */
    public function getHeaders(){
        return [
            'X-EBAY-API-CALL-NAME:' . $this->getMethod(),
            'X-EBAY-API-SITEID:' . $this->siteId,
            // Site 0 is for US
            'X-EBAY-API-APP-NAME:' . $this->keys['app_name'],
            'X-EBAY-API-DEV-NAME:' . $this->keys['dev_name'],
            'X-EBAY-API-CERT-NAME:' . $this->keys['cert_name'],
            'X-EBAY-API-COMPATIBILITY-LEVEL:' . $this->getVersion(),
            'X-EBAY-API-REQUEST-ENCODING:XML',
            // for a POST request, the response by default is in the same format as the request
            'Content-Type:text/xml;charset=utf-8',
        ];
    }

    /**
     * @param integer $version
     * @return $this
     */
    public function setVersion($version){
        $this->version = $version;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVersion(){
        return $this->version;
    }
}