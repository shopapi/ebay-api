<?php
namespace Myw\EbayApiBundle\Type;

use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\SerializedName;

/**
 * @XmlRoot("RequesterCredentials")
 */
class RequesterCredentials
{
    /**
     * @var string
     * @SerializedName("eBayAuthToken")
     */
    private $eBayAuthToken;

    /**
     * @return string
     */
    public function getEBayAuthToken()
    {
        return $this->eBayAuthToken;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setEBayAuthToken($token)
    {
        $this->eBayAuthToken = $token;

        return $this;
    }
}
