<?php

namespace App\Domain;

interface RequestInterface
{
    public function validateRequestXml(): void;

    public function validateResponseXml(): bool;

    public function generateResponse(): string;
}