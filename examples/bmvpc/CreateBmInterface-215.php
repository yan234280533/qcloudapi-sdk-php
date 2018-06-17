<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';

$config = array('SecretId'       => 'AKID72i9LQDyPbZJp7v1d8QTIsEMFuLXqhRw',
    'SecretKey'      => 'Wnpb7OPAh16xc8QUKAnBON8evynOkslQ',
    'RequestMethod'  => 'GET',
    'DefaultRegion'  => 'cq');

$api = QcloudApi::load(QcloudApi::MODULE_BMVPC, $config);

$package = array('SignatureMethod' =>'HmacSHA256');

$package["unVpcId"] = "vpc-la7bp0gf";
$package["unSubnetId"] = "subnet-h3o44t6g";
$package["instanceIds.0"] = "cpm-2rndto66";

$rsp = $api->CreateBmInterface($package);

if ($rsp === false) {
    $error = $api->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
} else {
    var_dump($rsp);
}

echo "\nRequest :" . $api->getLastRequest();
echo "\nResponse :" . $api->getLastResponse();
echo "\n";