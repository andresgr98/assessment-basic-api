<?php

namespace App\Application;

use App\Domain\PingRequestCreator;
use App\Domain\ReverseRequestCreator;
use App\Infrastructure\XmlRequest;
use Exception;

class ApplicationController
{

    public function __construct()
    {
    }

    public function handle(XmlRequest $request)
    {
        $endpoint = (string) $request->getXmlObject()->header->type;

        $requestCreator = match ($endpoint) {
            'ping_request' => new PingRequestCreator(),
            'reverse_request' => new ReverseRequestCreator(),
            default => throw new Exception("No endpoint specified"),
        };

        $request = $requestCreator->createRequest($request);
        $response = $request->generateResponse();

        echo $response;
        exit();
    }




}