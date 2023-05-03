<?php

namespace App\Domain;

use App\Infrastructure\XmlRequest;

class ReverseRequest implements RequestInterface
{
    public function __construct(XmlRequest $xml)
    {
        $this->xml = $xml;
    }

    public function validateRequestXml(): void
    {
        //TODO: implement
    }

    public function validateResponseXml(): bool
    {
        //TODO: implement
        return true;
    }

    public function generateResponse(): string
    {
        //TODO: implement
        return 'reverse_response';
    }

}