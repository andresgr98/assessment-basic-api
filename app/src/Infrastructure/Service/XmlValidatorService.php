<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Exception\XmlValidationException;
use DOMDocument;

class XmlValidatorService
{

    private static ?XmlValidatorService $instance = null;

    private function __construct()
    {

    }

    public static function getInstance(): XmlValidatorService
    {
        if (self::$instance == null) {
            self::$instance = new XmlValidatorService();
        }
        return self::$instance;
    }

    public function validate(string $xml, string $xsdPath): void
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument('1.0');
        $dom->loadXML($xml, LIBXML_NOERROR);
        if (!$dom->schemaValidate($xsdPath)) {
           throw new XmlValidationException("Could not validate XML");
        }
    }
}