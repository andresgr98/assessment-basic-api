<?php
error_reporting(E_ERROR | E_PARSE);
include '../../init.php';

use App\Core\Container;
use App\Service\PingRequestCreator;
use App\Service\ReverseRequestCreator;
use App\Service\XmlValidatorService;

require_once __DIR__ . '/../vendor/autoload.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    throw new Exception("Invalid HTTP Method. Only POST allowed.");
}

var_dump(file_get_contents(ROOT_DIR . "/files/xsds/ping_request.xsd"));

$container = new Container();
$container->addService('XmlValidatorService', XmlValidatorService::getInstance());

function getContainer()
{
    global $container;
    return $container;
}

$xml = file_get_contents("php://input");
$xmlRequest = simplexml_load_string($xml);

$endpoint = (string) $xmlRequest->header->type;

$requestCreator = match ($endpoint) {
    'ping_request' => new PingRequestCreator(),
    'reverse_request' => new ReverseRequestCreator(),
    default => throw new Exception("No endpoint specified"),
};

$request = $requestCreator->createRequest($xmlRequest);
$response = $request->generateResponse();

echo $response;
exit();