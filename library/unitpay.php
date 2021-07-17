<?php

require_once('./functions.php');
require_once('../config.php');
require_once('./rcon.class.php');

$unitpay_ips = [
    '31.186.100.49',
    '178.132.203.105',
    '52.29.152.23',
    '52.19.56.234',
    '127.0.0.1'
];

function unitpayResponse($message, $status) {
    return json_encode(array($status => array(
        'message' => $message,
    )), JSON_UNESCAPED_UNICODE);
}

function sendUnitResponse($message = '', $status = 'error') {
    echo unitpayResponse($message, $status);

    die;
}

function getSignature($method, array $params, $secretKey) {
    ksort($params);
    unset($params['sign']);
    unset($params['signature']);
    array_push($params, $secretKey);
    array_unshift($params, $method);
    return hash('sha256', join('{up}', $params));
}

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

if (isset($_REQUEST['method']) && isset($_REQUEST['params'])) {
    $params = $_REQUEST['params'];
    $goodParams = explode('-', $params['account']);

    if ($params['signature'] != getSignature($_REQUEST['method'], $params, $config['unitpay']['key']))
        sendUnitResponse('Ошибка доступа');

    if (count($goodParams) < 2)
        sendUnitResponse('Неправильный аккаунт');

    $currentGood = findGood($config, $goodParams[1]);

    if ($currentGood == null)
        sendUnitResponse('Привилегия отсутствует');

    if (isset($currentGood['amounted']) && $currentGood['amounted'] && !isset($goodParams[2]))
        sendUnitResponse('Неправильное количество');

    $price = calculatePrice($goodParams[0], $currentGood, isset($goodParams[2]) ? $goodParams[2] : 0, $config);

    if ($price != $params['orderSum'] || $params['orderCurrency'] != 'RUB')
        sendUnitResponse('Неверная цена!');

    switch($_REQUEST['method']) {
        case 'pay':
            $db = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['db']) or die('Ошибка подключения к БД, обновите страницу.');

            $stmt = $db->prepare("INSERT INTO `purchases` (`username`, `title`, `amount`, `image`) VALUES (?, ?, ?, ?)");
            $goodCount = (isset($currentGood['amounted']) && $currentGood['amounted']) ? $goodParams[2] : null;
            $stmt->bind_param('ssds',  $goodParams[0], $currentGood['title'], $goodCount, $currentGood['image']);
            $stmt->execute();
            giveDonate($config, $goodParams);
            sendUnitResponse('Услуга выдана', 'result');
            break;
        default:
            sendUnitResponse('Параметры верны. Платёж разрешён', 'result');
            break;
    }

} else {
    sendUnitResponse("Error");
}