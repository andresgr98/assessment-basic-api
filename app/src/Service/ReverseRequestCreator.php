<?php

namespace App\Service;

use SimpleXMLElement;

class ReverseRequestCreator extends RequestCreator
{

    public function __construct()
    {
    }
    function createRequest(SimpleXMLElement $xml): RequestInterface
    {
        return new ReverseRequest($xml);
    }
}