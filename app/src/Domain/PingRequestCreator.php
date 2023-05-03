<?php

namespace App\Domain;

use App\Infrastructure\Service\XmlRequest;

class PingRequestCreator extends RequestCreator
{

    public function __construct()
    {
    }

    function createRequest(XmlRequest $xml): RequestInterface
    {
        return new PingRequest($xml);
    }
}