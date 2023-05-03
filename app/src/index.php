<?php
require_once __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);

//TODO: fix this include
//include '../../init.php';

use App\Application\ApplicationController;
use App\Infrastructure\Container;
use App\Infrastructure\Service\XmlValidatorService;
use App\Infrastructure\XmlRequest;


$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    throw new Exception("Invalid HTTP Method. Only POST allowed.");
}

$container = new Container();
$container->addService('XmlValidatorService', XmlValidatorService::getInstance());

$request = getRequest();
$application = new ApplicationController();
$application->handle($request);

function getContainer(): Container
{
    global $container;
    return $container;
}

function getRequest(): XmlRequest
{
    $xml = file_get_contents("php://input");
    return new XmlRequest($xml);
}