<?php

namespace App\Service;

use DOMDocument;

class XmlValidatorService
{

    private static $instance = null;

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

    public function validate(string $xml, string $xsdPath): bool
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument('1.0');
        $dom->loadXML($xml, LIBXML_NOERROR);

        if ($dom->schemaValidate($xsdPath)) {
            return true;
        }

        return false;
    }
}