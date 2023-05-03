<?php

namespace App\Domain;

use App\Infrastructure\XmlRequest;

abstract class RequestCreator
{
    abstract function createRequest(XmlRequest $xml): RequestInterface;

}