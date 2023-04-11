<?php

namespace App\Service;

use SimpleXMLElement;

class ReverseRequest implements RequestInterface
{
    public function __construct(SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    public function validateRequestXml(): bool
    {
        return $this->xml;
    }

    public function validateResponseXml(): bool
    {
        return $this->xml;
    }

    public function generateResponse(): string
    {
        return 'reverse_response';
    }

}