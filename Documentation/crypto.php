<?php
require("../vendor/autoload.php");
$openapi = \OpenApi\scan('../Public');
header('Content-Type:application/json');
echo $openapi->toJSON();