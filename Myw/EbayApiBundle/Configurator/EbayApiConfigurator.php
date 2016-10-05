<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m.benhenda
 * Date: 07/04/15
 * Time: 17:46
 * To change this template use File | Settings | File Templates.
 */

namespace Myw\EbayApiBundle\Configurator;

use Myw\EbayApiBundle\Manager\EbayManagerInterface;
use Myw\EbayApiBundle\Component\EbayComponentInterface;
use Myw\EbayApiBundle\Call\MakeCall;

/**
 * Class EbayApiConfigurator
 * @package Myw\EbayApiBundle\Configurator
 */
class EbayApiConfigurator
{

    /**
     * @var EbayManagerInterface
     */
    private $apiManager;
    /**
     * @var MakeCall
     */
    private $call;

    /**
     * EbayApiConfigurator constructor.
     * @param EbayManagerInterface $ebayApiManager
     * @param MakeCall             $call
     */
    public function __construct(EbayManagerInterface $ebayApiManager, MakeCall $call)
    {
        $this->apiManager = $ebayApiManager;
        $this->call = $call;
    }

    /**
     * @param EbayComponentInterface $ebayComponent
     */
    public function configure(EbayComponentInterface $ebayComponent)
    {
        $oComponent = $ebayComponent->instanceComponent($this->apiManager->getApi(), $this->apiManager->getMethod(), $this->apiManager->getMode());
        $this->call->getResponse($oComponent);
    }
}