<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m.benhenda
 * Date: 07/04/15
 * Time: 16:53
 * To change this template use File | Settings | File Templates.
 */

namespace Myw\EbayApiBundle\Manager;

use Myw\EbayApiBundle\Manager\EbayManagerInterface;
use Myw\EbayApiBundle\Type\RequesterCredentials;
use Myw\EbayApiBundle\Component\Trading\EbayApiTradingComponent;

/**
 * Class EbayApiManager
 * @package Myw\EbayApiBundle\Manager
 */
class EbayApiManager implements EbayManagerInterface
{
    const MODE_SANDBOX = 0;
    const MODE_PRODUCT = 1;

    /**
     * @var
     */
    public $parameters;
    /**
     * @var
     */
    protected $api;
    /**
     * @var
     */
    protected $method;
    /**
     * @var int
     */
    protected $mode = 0;

    /**
     * @param string  $api
     * @param string  $method
     * @param integer $mode
     * @return mixed
     */
    public function getManager($api, $method, $mode)
    {
        $className = 'Myw\\EbayApiBundle\\Component\\'.$api.'\\'.ucfirst($method).'Component';

        $component = new $className($this->getParameters(), $mode, $method);
        $requesterCredentials = new RequesterCredentials();

        $requesterCredentials->setEBayAuthToken($this->getParameters()['auth_token']);
        $component->setRequesterCredentials($requesterCredentials);

        $ApiVersion = array_key_exists('version', $this->getParameters()) ? $this->getParameters()['version']: EbayApiTradingComponent::API_VERSION;
        $warningLevel = array_key_exists('warning_level', $this->getParameters()) ? $this->getParameters()['warning_level']: EbayApiTradingComponent::WARNING_LEVEL;
        $component->setVersion($ApiVersion);
        $component->setWarningLevel($warningLevel);

        return $component;
    }

    /**
     * @param $configEbayApi
     */
    public function setConfig($configEbayApi)
    {
        $this->setParameters($configEbayApi);
    }

    /**
     * @param $config
     * @return $this
     */
    public function setParameters($config)
    {
        $this->parameters = $config;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

}