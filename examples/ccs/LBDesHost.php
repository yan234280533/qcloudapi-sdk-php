<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => 'AKIDrXy82fv6uVsynLAbOuCE9nCJ9hyxq5E6',
    'SecretKey'      => 'jBMGtFL98rJVSDixxg9LHxNaaJlwqT4P',
    'RequestMethod'  => 'GET',
    'DefaultRegion'  => 'yhcq');

$api = QcloudApi::load(QcloudApi::MODULE_LB, $config);

$package = array('SignatureMethod' =>'HmacSHA256');

$package["loadBalancerId"] = "lb-qgjuw2bg";
$package["listenerId"] = 'lbl-3306bl4s';

#$aa = array("instanceId"=>"ins-k2xjs7m9");

#$package["backends"] = array("0"=>$aa);

$package["backends.0.instanceId"] = "ins-jjff9715";
$package["backends.0.port"] = 30460;

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