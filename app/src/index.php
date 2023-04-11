<?php
echo "Hola mundo";

$request = file_get_contents("php://input");
$xmlRequest = simplexml_load_string($request);