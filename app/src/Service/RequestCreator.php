<?php

namespace App\Service;

use SimpleXMLElement;

abstract class RequestCreator
{
    abstract function createRequest(SimpleXMLElement $xml): RequestInterface;

}