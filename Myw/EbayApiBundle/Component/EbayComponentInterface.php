<?php
/**
 * Created by PhpStorm.
 * User: med
 * Date: 07/04/2015
 * Time: 23:00
 */

namespace Myw\EbayApiBundle\Component;


interface EbayComponentInterface {
    public function instanceComponent($api, $method, $mode);
}