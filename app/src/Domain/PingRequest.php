<?php

namespace App\Domain;

use App\Infrastructure\Exception\XmlValidationException;
use App\Infrastructure\XmlRequest;
use SimpleXMLElement;

class PingRequest implements RequestInterface
{
    private XmlRequest $xmlRequest;
    private string $xsdRequestPath = __DIR__ . "/../../../files/xsds/ping_request.xsd";
    private string $xsdResponsePath = __DIR__ . "/../../../files/xsds/ping_response.xsd";
    private mixed $xmlValidatorService;

    public function __construct(XmlRequest $xml)
    {
        $this->xmlValidatorService = getContainer()->get('XmlValidatorService');
        $this->xmlRequest = $xml;
    }

    public function validateRequestXml(): void
    {
        $this->xmlValidatorService->validate($this->xmlRequest->getXml(), $this->xsdRequestPath);
    }

    public function validateResponseXml(): bool
    {
       return $this->xmlValidatorService->validate($this->xmlRequest->getXml(), $this->xsdResponsePath);
    }

    public function generateResponse(): string
    {
        try {
            //TODO: fix validation
            $this->validateRequestXml();

            $xmlResponse = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><ping_response />');
            $header = $xmlResponse->addChild("header", "");
            $header->addchild("type", "ping_response");
            $header->addchild("sender", "DEMO");
            $header->addchild("recipient", "Enreach");
            $header->addchild("reference", "ping_response12345678");
            $header->addchild("timestamp", date("Y-m-d\TH:i:s\.ms"));
            $body = $xmlResponse->addChild("body", "");
            $body->addChild("echo", $this->xmlRequest->getXmlObject()->body->echo);
            header("Content-type: text/xml; charset=utf-8");
            return $xmlResponse->asXML();
        } catch(XmlValidationException $e) {
            //TODO: handle
            throw $e;
        }




    }

}