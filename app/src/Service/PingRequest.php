<?php

namespace App\Service;

use App\Core\Container;
use SimpleXMLElement;

class PingRequest implements RequestInterface
{
    private Container $container;
    private string $xml;
    const XSD_PATH = ROOT_DIR . "/files/xsds/ping_request.xsd";
    private mixed $xmlValidatorService;

    public function __construct(SimpleXMLElement $xml)
    {
        $this->xmlValidatorService = getContainer()->get('XmlValidatorService');
        $this->xml = $xml;
    }

    public function validateRequestXml(): bool
    {
        return $this->xmlValidatorService->validate($this->xml, self::XSD_PATH);
    }

    public function validateResponseXml(): bool
    {
        return $this->xml;
    }

    public function generateResponse(): string
    {
        if ($this->validateRequestXml()) {
            return 'ping_response';
        }
        return 'KO';
    }

}