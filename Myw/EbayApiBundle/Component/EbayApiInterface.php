<?php
/**
 * Created by PhpStorm.
 * User: med
 * Date: 22/04/2015
 * Time: 02:05
 */

namespace Myw\EbayApiBundle\Component;


interface EbayApiInterface
{

    public function setApi($api);

    public function setMethod($method);

    public function setMode($mode);
}