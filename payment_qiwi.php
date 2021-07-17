<?php
require_once('library/functions.php');
require_once('config.php');
require_once('library/rcon.class.php');

//Make sure that it is a POST request.
//if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
//    echo '<script type="text/javascript">window.location.href="/";</script>';
//    die();
//}

//$log_file = fopen(__DIR__ . '/qiwi.txt', 'a+');
//fwrite($log_file, print_r(json_decode(file_get_contents('php://input')), true).PHP_EOL);
//fwrite($log_file, print_r(getallheaders(), true).PHP_EOL);
//fclose($log_file);

//Receive the RAW post data.
$json = file_get_contents('php://input');

$decoded = json_decode($json, true);

$log = fopen(__DIR__ . '/qiwi.txt', 'a+');
fwrite($log, print_r($decoded, true).PHP_EOL);
fwrite($log, print_r(getallheaders(), true).PHP_EOL);
fclose($log);

//Attempt to decode the incoming RAW post data from JSON.

//If json_decode failed, the JSON is invalid.
//if(!is_array($decoded)){
//    die();
//}

//if($decoded['bill']['siteId'] !== $config['qiwi']['site_id']) die();
//if($decoded['bill']['status']['value'] !== 'PAID') die();


function giveDonate($config, $goodParams, $rLength = 0) {
    if ($rLength == 10) {
        return;
    }

    $currentGood = findGood($config, $goodParams[1]);
    $cmd = str_replace(['%user%', '%group%', '%amount%'], [$goodParams[0], $goodParams[1], isset($goodParams[2]) ? $goodParams[2] : 0], $currentGood['command']);
    $rcon = new Rcon($config['rcon']['ip'], $config['rcon']['port'], $config['rcon']['password'], 10);

    if (@$rcon->connect()) {
        @$rcon->send_command($cmd);
    } else {
        giveDonate($config, $goodParams, $rLength + 1);
    }
}

$goodParams = explode('-', $decoded['bill']['customer']['account']);

if (count($goodParams) < 2)
    sendUnitResponse('Неправильный аккаунт');

$currentGood = findGood($config, $goodParams[1]);

if ($currentGood == null)
    sendUnitResponse('Привилегия отсутствует');

if (isset($currentGood['amounted']) && $currentGood['amounted'] && !isset($goodParams[2]))
    sendUnitResponse('Неправильное количество');

$price = calculatePrice($goodParams[0], $currentGood, isset($goodParams[2]) ? $goodParams[2] : 0, $config);

if ($price != $decoded['bill']['amount']['value'])
    sendUnitResponse('Неверная цена!');

if ($decoded['bill']['status']['value'] == 'PAID') {

    $db = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['db']);

    $stmt = $db->prepare("INSERT INTO `purchases` (`username`, `title`, `amount`, `image`) VALUES (?, ?, ?, ?)");
    $goodCount = (isset($currentGood['amount']) && $currentGood['amount']) ? $goodParams[2] : null;
    $stmt->bind_param('ssds',  $goodParams[0], $currentGood['title'], $goodCount, $currentGood['image']);
    $stmt->execute();
    giveDonate($config, $goodParams);

} else {
	die();
}

