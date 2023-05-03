<?php

namespace App\Domain;


use App\Infrastructure\XmlRequest;

class ReverseRequestCreator extends RequestCreator
{

    public function __construct()
    {
    }
    function createRequest(XmlRequest $xml): RequestInterface
    {
        return new ReverseRequest($xml);
    }
}