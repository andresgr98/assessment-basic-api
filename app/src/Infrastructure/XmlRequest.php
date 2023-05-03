<?php

namespace App\Infrastructure;

use SimpleXMLElement;

class XmlRequest
{
    private string $xml;
    public function __construct(string $xml)
    {
        $this->xml = $xml;
    }

    public function getXml(): string
    {
        return $this->xml;
    }

    public function getXmlObject(): SimpleXMLElement
    {
        return simplexml_load_string($this->xml);
    }



}