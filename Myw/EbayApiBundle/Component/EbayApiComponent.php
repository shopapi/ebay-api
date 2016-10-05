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

/**
 * Class EbayApiComponent
 * @package Myw\EbayApiBundle\Component
 */
class EbayApiComponent implements EbayComponentInterface
{
    const MODE_SANDBOX = 0;
    const MODE_PRODUCT = 1;

    /**
     * @var $api
     */
    protected $api;
    /**
     * @var $method
     */
    protected $method;
    /**
     * @var $mode
     */
    protected $mode;
    /**
     * @var $parameters
     */
    protected $parameters;
    /**
     * @var array $keys
     */
    protected $keys;
    /**
     * @var $component
     */
    protected $component;
    /**
     * @var $format
     */
    protected $format;
    /**
     * @var int $siteId
     */
    protected $siteId = 0; // US by default

    /**
     * @param string $api
     * @param string $method
     * @param string $mode
     * @return mixed
     */
    public function instanceComponent($api, $method, $mode)
    {
        $className = 'Myw\\EbayApiBundle\\Component\\'.$api.'\\'.ucfirst($method).'Component';

        $component = new $className($this->getKeys());
        /* $keys = ($mode === self::MODE_PRODUCT) ? $this->parameters['application_keys']['production'] : $this->parameters['application_keys']['sandbox'];*/
        //$component->setApiName($api)->setCallName($method)->setMode($mode)->setKeys($keys);

        return $component;
    }

    /**
     * @param EbayApiInterface $component
     * @return $this
     */
    public function setComponent(EbayApiInterface $component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @param $configEbayApi
     */
    public function setConfig($configEbayApi)
    {
        $this->setKeys($configEbayApi);
    }

    /**
     * @param array $config
     * @return $this
     */
    public function setKeys(array $config)
    {
        $this->keys = $config;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }
}
