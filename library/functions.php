<?php

function formatResponse($message = '', $status) {
    return json_encode(array(
        'status' => $status,
        'message' => $message,
    ), JSON_UNESCAPED_UNICODE);
}

function sendResponse($message, $status = 'failed') {
    echo formatResponse($message, $status);

    die;
}

function findGood($config, $good) {
    foreach ($config['categories'] as $category) {
        foreach ($category['products'] as $k => $v) {
            if ($k === $good) {
                return $v;
            }
        }
    }

    return null;
}

function oldGoodPrice($user, $config) {
    $db = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['db']) or die('Ошибка подключения к БД, обновите страницу.');

    $stmt = $db->prepare("SELECT * FROM luckperms_players WHERE username = ? LIMIT 1");
    $stmt->bind_param('s', $user);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_object();
    if ($result !== null) {
        $group = $result->primary_group;

        $oldGood = findGood($config, $group);

        if (!$oldGood)
            return 0;

        return $oldGood['price'];
    }

    return 0;
}

function calculatePrice($user, $good, $amount, $config) {
    if (isset($good['amounted']) && $good['amounted']) {
        return $good['price'] * $amount;
    }

    if (!$good['withSurcharge']) {
        return $good['price'];
    }

    $oldPrice = oldGoodPrice($user, $config);

    if ($oldPrice == 0) {
        return $good['price'];
    } else if ($oldPrice < $good['price']) {
        return intval($good['price'] - $oldPrice);
    } else {
        return null;
    }
}