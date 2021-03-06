<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m.benhenda
 * Date: 07/04/15
 * Time: 16:54
 * To change this template use File | Settings | File Templates.
 */

namespace Myw\EbayApiBundle\Component;

use JMS\Serializer\Annotation\ExclusionPolicy;

class EbayApiComponent implements EbayComponentInterface {

    CONST MODE_SANDBOX = 0;
    CONST MODE_PRODUCT = 1;

    protected $api;
    protected $method;
    protected $mode;
    protected $parameters;
    protected $keys;
    protected $component;
    protected $format;
    protected $siteId = 0; // US by default

    public function instanceComponent($api, $method, $mode)
    {
        $className = 'Myw\\EbayApiBundle\\Component\\' . $api . '\\' . ucfirst($method) . 'Component';

        $component = new $className($this->getKeys());
       /* $keys = ($mode === self::MODE_PRODUCT) ? $this->parameters['application_keys']['production'] : $this->parameters['application_keys']['sandbox'];*/
        //$component->setApiName($api)->setCallName($method)->setMode($mode)->setKeys($keys);

        return $component;
    }

    public function setComponent(EbayApiInterface $component){
        $this->component = $component;
        return $this;
    }

    public function getComponent(){
        return $this->component;
    }

    public function setConfig($configEbayApi)
    {
        $this->setKeys($configEbayApi);
    }

    public function setKeys($config)
    {
        $this->keys = $config;
        return $this;
    }

    public function getKeys()
    {
        return $this->keys;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }




}