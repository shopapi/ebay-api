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

class EbayApiConfigurator {

    private $apiManager;
    private $call;

    public function __construct(EbayManagerInterface $ebayApiManager, MakeCall $call )
    {
        $this->apiManager = $ebayApiManager;
        $this->call = $call;
    }

    public function configure(EbayComponentInterface $ebayComponent)
    {

        $oComponent = $ebayComponent->instanceComponent($this->apiManager->getApi(), $this->apiManager->getMethod(), $this->apiManager->getMode() );
       // $oComponent->getConfig();
       // $ebayComponent->setComponent($oComponent);
       // print_r($oComponent);exit();
       // $oComponent->call($this->serializer);
        $this->call->getResponse($oComponent);
    }
}