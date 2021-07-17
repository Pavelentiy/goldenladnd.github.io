<?php
@session_start();
require_once('../config.php');
require_once('./functions.php');

if (!isset($_GET['username']) || empty($_GET['username'])) {
    echo 'Укажите имя игрока';
	die;
}

if (!isset($_GET['good']) || empty($_GET['good'])) {
    echo 'Выберите товар';
    die;
}

$currentGood = findGood($config, $_GET['good']);

if ($currentGood == null) {
    echo 'Товар не найден';
    die;
}

$sum = calculatePrice($_GET['username'], $currentGood, $_GET['amount'], $config);

if ($sum == null) {
    sendResponse('Выберите привилегию дороже');
}

if (isset($currentGood['amounted']) && $currentGood['amounted'] && (!isset($_GET['amount']) || empty($_GET['amount']))) {
    echo 'Укажите количество';
    die;
}

$sum = calculatePrice($_GET['username'], $currentGood, $_GET['amount'], $config);

if ($sum == null) {
    sendResponse('Выберите привилегию дороже');
}

if (!isset($currentGood['amounted'])) {
    $currentGood['amounted'] = false;
}

$account = $currentGood['amounted'] ? "{$_GET['username']}-{$_GET['good']}-{$_GET['amount']}" : "{$_GET['username']}-{$_GET['good']}";
$desc = "Покупка игровой привилегии на сайте {$config['site_name']}";
$currency = "RUB";

$secretKey = $config['unitpay']['key'];

function getFormSignature($account, $currency, $desc, $sum, $secretKey) {
	$hashStr = $account.'{up}'.$currency.'{up}'.$desc.'{up}'.$sum.'{up}'.$secretKey;
	return hash('sha256', $hashStr);
}

$signature = getFormSignature($account, $currency, $desc, $sum, $secretKey);

$_SESSION['unitpay']= "https://unitpay.money/pay/{$config['unitpay']['project_id']}?account={$account}&currency={$currency}&desc={$desc}&sum={$sum}&signature={$signature}";
$_SESSION['qiwi'] = "https://oplata.qiwi.com/create?publicKey={$config['qiwi']['public_key']}&amount={$sum}&account={$account}&comment={$desc}&successUrl=https://cubea.ru/";
header( "Location: /select.php");