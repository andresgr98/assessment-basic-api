<?php
require_once __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);

//TODO: fix this include
//include '../../init.php';

use App\Domain\PingRequestCreator;
use App\Domain\ReverseRequestCreator;
use App\Infrastructure\Container;
use App\Infrastructure\Service\XmlRequest;
use App\Infrastructure\Service\XmlValidatorService;


$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    throw new Exception("Invalid HTTP Method. Only POST allowed.");
}

$container = new Container();
$container->addService('XmlValidatorService', XmlValidatorService::getInstance());

$xml = file_get_contents("php://input");
$xmlRequest = new XmlRequest($xml);

$endpoint = (string) $xmlRequest->getXmlObject()->header->type;

$requestCreator = match ($endpoint) {
    'ping_request' => new PingRequestCreator(),
    'reverse_request' => new ReverseRequestCreator(),
    default => throw new Exception("No endpoint specified"),
};

$request = $requestCreator->createRequest($xmlRequest);
$response = $request->generateResponse();

echo $response;
exit();

function getContainer(): Container
{
    global $container;
    return $container;
}