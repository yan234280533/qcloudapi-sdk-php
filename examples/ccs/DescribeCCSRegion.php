<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => getenv('TENCENTCLOUD_SECRET_ID'),
    'SecretKey'      => getenv('TENCENTCLOUD_SECRET_KEY'),
    'RequestMethod'  => 'GET',
    'DefaultRegion'  => 'yhcq');

$api = QcloudApi::load(QcloudApi::MODULE_CCS, $config);

$package = array('SignatureMethod' =>'HmacSHA256');
$package["clusterId"] = "cls-2ymqi92f";
$package["serviceName"] = "aaaaa";

$rsp = $api->DescribeCCSRegion($package);

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
