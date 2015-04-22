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

class EbayApiManager implements  EbayManagerInterface{

    const MODE_SANDBOX = 0;
    const MODE_PRODUCT = 1;

    public $parameters;
    protected $api;
    protected $method;
    protected $mode = 0;

    public function getManager($api, $method, $mode){
        $this->setApi($api);
        $this->setMethod($method);
        $this->setMode($mode);
    }
    public function getApi(){
        return $this->api;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getMode(){
        return $this->mode;
    }

    public function setApi($api){
        $this->api = $api;
        return $this;
    }

    public function setMethod($method){
        $this->method = $method;
        return $this;
    }

    public function setMode($mode = self::MODE_SANDBOX){
        $this->mode = $mode;
        return $this;
    }
}