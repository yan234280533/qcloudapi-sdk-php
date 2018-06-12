<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => 'AKIDCJJE4l0fhd3OfmNxMhv2yR6bZSBn8NZf',
    'SecretKey'      => 'eNwvoW3iEZmofLsElLn5CGCydCbraBc3',
    'RequestMethod'  => 'GET',
    'DefaultRegion'  => 'bj');

$api = QcloudApi::load(QcloudApi::MODULE_LB, $config);

$package = array('SignatureMethod' =>'HmacSHA256');

$package["loadBalancerId"] = "lb-2gckl5nz";
$package["listenerId"] = 'lbl-840rkpjh';

#$aa = array("instanceId"=>"ins-cy0cds3n","port"=>80);

$package["backends.0.instanceId"] = "ins-cy0cds3n";
$package["backends.0.port"] = 80;

echo var_export($package, true);

$rsp = $api->DeregisterInstancesFromForwardLBFourthListener($package);

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