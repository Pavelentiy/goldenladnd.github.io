<?php
require_once('./config.php');
$db = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['db']) or die('Ошибка подключения к БД, обновите страницу.');

$lastPurchases = mysqli_query($db, "SELECT * FROM `purchases` ORDER BY id DESC LIMIT 5");
?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <title><?= $config['site_name'] ?> - Покупка доната, привилегий, ключей, кейсов</title>
        <meta name="description"
              content="<?= $config['description'] ?>">
        <meta name="keywords" content="<?= $config['description'] ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700&display=swap&subset=cyrillic"
              rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet">
        <link href="assets/style.css" rel="stylesheet">
    </head>

    <body>

    <div class="header">
        <div class="container">
            <div class="navbar">
                <a href="#" rel="nofollow" class="navbar-mobile"><i class="fa fa-bars"></i></a>
                <div class="navbar-wrapper">
                    <div class="block-left">
                        <a href="/" class="logo" rel="nofollow">
                            <div class="block-left">
                                <div class="logo-lt"></div>
                            </div>
                            <div class="block-right">
                                <span class="col-deep-purple">Cubea</span>
                            </div>
                        </a>
                    </div>

                    <div class="block-center"></div>

                    <div class="block-right">
                        <ul>
                            <li class="active"><a href="/" rel="nofollow"><i class="fa fa-shopping-basket"></i> Главная</a>
                            </li>

                            <li><a href="#" data-modal="donate" rel="nofollow"><i class="fa fa-file-text"></i> Описание
                                    доната</a></li>
                                    <li><a href="#" data-modal="rules" rel="nofollow"><i class="fa fa-book"></i> Правила</a></li>
                            <li><a href="https://vk.com/im?sel=-168163524" target="_blank" rel="nofollow"><i
                                            class="fa fa-comments"></i> Поддержка</a></li>
                            <li><a href="https://vk.com/cub_ea" target="_blank" rel="nofollow"><i
                                            class="fa fa-vk"></i> Группа ВК</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<body>
	
        <?php echo $content_menu;?>
      	<div class="jumbotron jumbotron-fluid text-center">
        	<div class="container">
        	        	
        	        	
        	        	<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="../image/anonc/anonc-1.png" class="d-block w-2" alt="1">
    </div>
  </div>
</div>

    <div class="container">
        <div class="tabs">
            <div class="tabs-wrapper">
                <div class="block-left">
                    <ul class="tab-links">
                        <?php
                        foreach ($config["categories"] as $key => $value):
                            ?>
                            <li class="<?= ($value['default'] ? 'active' : '') ?>" data-id="<?= $key ?>">
                                <a href="#" rel="nofollow">
                                    <span class="block-left"><i class="fa fa-tags "></i></span>
                                    <span class="block-right"><?= $value['title'] ?></span>
                                </a>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>

                <div class="block-right">
                    <button class="btn block copy-clipboard text-upper text-bold"
                            data-clipboard-text="<?= $config['server_ip'] ?>">
                        <?= $config['server_ip'] ?>
                    </button>
                </div>
            </div>
            <div class="tab-list">
                <?php foreach ($config["categories"] as $key => $value): ?>
                    <div class="tab-id <?= ((isset($value['default']) && $value['default']) ? "active" : "") ?>"
                         data-id="<?= $key ?>">
                        <?php if (isset($value['notify'])): ?>
                            <div class="category-text pb-20">
                                <div class="panel"><?= $value['notify'] ?></div>
                            </div>
                        <?php endif; ?>
                        <div class="items">
                            <?php foreach ($value['products'] as $k => $v): ?>
                                <div class="item-id" data-modal="paymodal"
                                     data-amounted="<?= ((isset($v['amounted']) && $v['amounted']) ? "1" : "") ?>"
                                     data-name="<?= $k ?>" data-price="<?= $v['price'] ?>"
                                     data-withSurcharge="<?= ((isset($v['withSurcharge']) && $v['withSurcharge']) ? "1" : "") ?>">
                                    <div class="image" style="background-image: url('<?= $v['image'] ?>');"></div>
                                    <div class="title"><?= $v['title'] ?></div>
                                    <div class="price"><?= $v['price'] ?> <i class="fa fa-ruble col-black"></i></div>
                                    <?php if (isset($v['discount']) && $v['discount'] > 0): ?>
                                        <div class="discount">-<?= $v['discount'] ?>%</div><?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="payments">
            <div class="blockname">Последние покупки</div>
            <div class="payment-list">
                <?php if ($lastPurchases):
                    while($lastPurchase = $lastPurchases->fetch_assoc()):
                ?>
                <div class="payment-id window item-id" style="display: block;">
                    <div class="image" style="background-image: url(<?=$lastPurchase['image']?>);"></div>
                    <div class="title"><?=$lastPurchase['title']?></div>
                    <div class="player">─ <?=$lastPurchase['username']?></div>
                    <?php if (isset($lastPurchase['amount']) && $lastPurchase['amount'] > 1): echo "<div class='amount'>x{$lastPurchase['amount']}</div>"; endif ?>
                </div>
                <?php
                    endwhile;
                    else:
                ?>
                <p>Нет последних покупок</p>
                <?php endif; ?>
        </div>
    </div>

    <div class="modal" data-id="paymodal">
        <div class="wrapper">
            <form id="buyform" method="get" action="library/makePayment.php" class="modal-content">
                <div class="modal-header text-center text-bold"></div>

                <input type="hidden" name="price" id="price" value="">
                <input type="hidden" name="good" id="good" value="">

                <div class="modal-body">
                    <div class="input-block">
                        <label for="login">Укажите Ваш никнейм на сервере</label>
                        <input type="text" name="username" id="login" placeholder="ВВЕДИТЕ НИКНЕЙМ">
                    </div>
                    <div id="amounted">
                        <br>
                        <div class="input-block">
                            <label for="amount">Укажите кол-во товара</label>
                            <input id="amount" type="number" min="1" step="1" name="amount" id="amount" value="1"
                                   placeholder="ВВЕДИТЕ КОЛ-ВО">
                        </div>
                    </div>
                </div>

                <div class="modal-footer text-right">
                    <button class="btn text-upper" id="submitBtn" type="submit">Оплатить</button>
                    <button data-modal-close class="btn text-upper btn-clear">Закрыть</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="block-left">
                <a href="/" class="logo" rel="nofollow">
                    <div class="block-left">
                        <div class="logo-lt"></div>
                        <div class="logo-rb"></div>
                    </div>
                    <div class="block-right">
                        <span class="col-deep-purple">Cubea</span><span class="col-black"></span>
                    </div>
                </a>
            </div>

            <div class="block-center">
                Полное или частичное копирование сайта запрещено © <?= $config['site_name'] ?>
            </div>
        </div>
    </footer>

<div class="modal" data-id="rules">
        <div class="wrapper">
            <div class="modal-content">
                <div class="modal-header text-center text-bold">Основные правила проекта CUBEA</div>

                <div class="modal-body">

                    <center>
                        <p><a href="/" rel="nofollow" class="btn btn-success">Приобрести донат</a></p>
                        <br>
                        <p>
                        <h2><font color="black" face="Arial">Пользовательское соглашение Cubea

1.1 При регистрации вы автоматически принимаете и соглашаетесь в перечисленными ниже правилами.<br>

1.2 Администрация оставляет за собой право редактировать правила, не извещая об этом пользователей. <br>

1.2.1 Администрация имеет полное право наказывать игроков без объяснения причин. <br>

1.3 Администрация не несет ответственность за безопасность аккаунта игрока. В случае его взлома администрация имеет право отказать в восстановлении вашего аккаунта. <br>
1.4 Вы соглашаетесь с тем, что любые потерянные вами игровые ресурсы, привелегии, деньги, переведенные на счет аккаунта, товары, купленные в онлайн магазине не возвращаются ни при каких условиях и обстоятельствах. Все перечисления на счет являются добровольными пожертвованиями для развития и поддержания проекта.<br> 
1.4.1 Администрация в праве не возвращать предметы, которые былы утрачены в связи с вашей смертью, багом, и т.д! <br>
1.4.2 Все слова «Купить», «Оплатить», «Доплатить» означают пожертвовние серверу! Деньги идут на оплату оборудования, разработку плагинов и зарплаты сотрудникам без которых мы бы уже закрылись. <br>
1.4.3 Все полученные Администрацией средства, являются добровольным пожертвованием и возврату не подлежат. <br>

1.5 Вы подтверждаете свою ознакомленность с тем, что ваш аккаунт, все собранное вами имущество, все следы активности на серверах и сайте могут быть безвозвратно удалены в случае отсутствия какой-либо активности более 30 дней, или заблокированы в случае нарушения одного из пункта правил. <br>

1.6 Вы даете полное согласие на сбор и разглашение вашей личной информации в случае нарушения правил. (ваши IP адреса, нарушающая правила личная переписка на сайте и игровых серверах и.т.д) <br></font></h2></p>
                        <br>

    <div class="modal" data-id="donate">
        <div class="wrapper">
            <div class="modal-content">
                <div class="modal-header text-center text-bold">Описание доната</div>

                <div class="modal-body">

                    <center>
                        <p><a href="/" rel="nofollow" class="btn btn-success">Приобрести донат</a></p>
                        <br>
                        <p>
                        <h2><font color="blue" face="Arial">Описание доната на режиме выживание "Вильемс"</font></h2></p>
                        <br>
                        <p>
                        <h1>SILVER</h1></p>
                        <br>
                        <img src="/image/imgdon/SILVER.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>GOLD</h1></p><br>
                        <img src="/image/imgdon/GOLD.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>EMERALD</h1></p><br>
                        <img src="/image/imgdon/EMERALD.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>DIAMOND</h1></p><br>
                        <img src="/image/imgdon/DIAMOND.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>STENDLY</h1></p><br>
                        <img src="/image/imgdon/STENDLY.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>LUCKY</h1></p><br>
                        <img src="/image/imgdon/LUCKY.png" class="img-fluid">
                        <hr>
                        <p>
                            <h2><font color="blue" face="Arial">Узнать больше о донате на других режимах /donate на любом сервере.</font></h2></p>
                        <br>
                        
                        <p>
                        <h1>Возникли проблемы?</h1></p><br>
                        <p>Ты всегда можешь обратиться в нашу службу поддержки!</p><br>
                        <p><a rel="nofollow" target="_blank" href="https://vk.com/im?sel=-168163524" class="btn btn-warning">Обратиться
                                в техническую поддержку</a></p>
                    </center>

                </div>

                <div class="modal-footer text-right">
                    <button data-modal-close class="btn btn-clear text-upper">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script src="/assets/script.js"></script>

    </body>
    </html>

<?php
