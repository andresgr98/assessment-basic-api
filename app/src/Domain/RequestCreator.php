<?php

namespace App\Domain;

use App\Infrastructure\Service\XmlRequest;

abstract class RequestCreator
{
    abstract function createRequest(XmlRequest $xml): RequestInterface;

}