<?php

namespace App\Infrastructure;

use Exception;

class Container
{
    private array $services = [];

    public function addService($name, $service)
    {
        $this->services[$name] = $service;
    }

    public function get($name)
    {
        if (!isset($this->services[$name])) {
            throw new Exception(sprintf('Service "%s" not found.', $name));
        }

        return $this->services[$name];
    }
}
