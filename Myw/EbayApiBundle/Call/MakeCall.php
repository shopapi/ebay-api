<?php
/**
 * Created by PhpStorm.
 * User: med
 * Date: 22/04/2015
 * Time: 03:16
 */


namespace Myw\EbayApiBundle\Call;

use Myw\EbayApiBundle\Component\EbayApiInterface;
use JMS\Serializer\Serializer;
use GuzzleHttp\Client;

/**
 * Class MakeCall
 * @package Myw\EbayApiBundle\Call
 */
class MakeCall
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * MakeCall constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param EbayApiInterface $component
     * @return array
     */
    public function getResponse(EbayApiInterface $component)
    {
        $timeout = 2.0;
        if (isset($component->keys['timeout'])) {
            $timeout = $component->keys['timeout'];
        }
        $client = new Client([
            'base_uri' => $component->getRequestUrl(),
            'timeout'  => $timeout,
        ]);
        $xmlRequest = $this->getPostFields($component);
        $component->setXmlRequest($xmlRequest);

        $ch = curl_init($component->getRequestUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $component->getHeaders());
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        if (isset($component->keys['timeout'])) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $component->keys['timeout']);
        }
        $data = curl_exec($ch);
        curl_close($ch);

        $arrayResponse = $this->xmlToarray($data);

        return $arrayResponse;
    }

    /**
     * @param EbayApiInterface $component
     * @return mixed|string
     */
    private function getPostFields(EbayApiInterface $component)
    {
        return $this->serializer->serialize($component, 'xml');
    }


    /*
     * Convert a XML to array
     * @param xml $xml
     * @return SimpleXmlIterator object
     */
    /**
     * @param $xml
     * @return array
     */
    private function xmlToarray($xml)
    {
        $xmlIterator = new \SimpleXmlIterator($xml, null);

        return $this->xmlIteratorToArray($xmlIterator);
    }

    /*
     * cover simpleXMLIterator and return array
     * @param SimpleXmlIterator $simpleXmlIterator
     * @return array
     */
    /**
     * @param $simpleXmlIterator
     * @return array
     */
    private function xmlIteratorToArray($simpleXmlIterator)
    {
        $aResponse = array();
        for ($simpleXmlIterator->rewind(); $simpleXmlIterator->valid(); $simpleXmlIterator->next()) {
            if (!array_key_exists($simpleXmlIterator->key(), $aResponse)) {
                $aResponse[$simpleXmlIterator->key()] = array();
            }
            if ($simpleXmlIterator->hasChildren()) {
                $aResponse[$simpleXmlIterator->key()][] = $this->xmlIteratorToArray($simpleXmlIterator->current());
            } else {
                $aResponse[$simpleXmlIterator->key()][] = strval($simpleXmlIterator->current());
            }
        }

        return $aResponse;
    }
}

