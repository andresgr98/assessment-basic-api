<?php

namespace App\Service;

use SimpleXMLElement;

class PingRequestCreator extends RequestCreator
{

    public function __construct()
    {
    }

    function createRequest(SimpleXMLElement $xml): RequestInterface
    {
        return new PingRequest($xml);
    }
}