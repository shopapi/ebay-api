<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m.benhenda
 * Date: 07/04/15
 * Time: 17:47
 * To change this template use File | Settings | File Templates.
 */

namespace Myw\EbayApiBundle\Manager;


interface EbayManagerInterface {

    public function getApi();
    public function getMethod();
    public function getMode();
    public function setApi($api);
    public function setMethod($method);
    public function setMode($mode);

}