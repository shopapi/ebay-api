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

class MakeCall {

    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getResponse(EbayApiInterface $component)
    {
        $input = $this->getPostFields($component);
        $component->setInput($input);
        $ch = curl_init($component->getRequestUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $component->getHeaders()); //set headers using the above array of headers
        curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
        if (isset($component->keys['timeout'])) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $component->keys['timeout']);
        }
        $data = curl_exec($ch);
        curl_close($ch);

        return preg_replace('/></', ">\n<", $data);
    }

    private function getPostFields(EbayApiInterface $component)
    {
        return $this->serializer->serialize($component, 'xml');
    }

}