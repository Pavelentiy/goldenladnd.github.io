 <?php

$config = [
    "site_name" => "Название сайта", // Название сервера
    "description" => "Самое время купить донат :) !", // Описание
    "keywords" => "Покупка доната Ваш проект", // Ключевые слова для поисковиков
    "server_ip" => " ", // IP сервера
    "db" => [ // Данные для доступа к БД
        "host" => " ",
        "user" => " ",
        "password" => " ",
        "db" => " ",
    ],
    "unitpay" => [ // Конфигурация юнитпея, key - секретный ключ, project_id - публичный ключ
        "project_id" => " ",
        "key" => " ",
    ],
    "qiwi" => [
        "site_id" => " ",
        "public_key" => " ",
    ],
     "rcon" => [ // Данные для RCON доступа
        "ip" => " ",
        "port" => " ",
        "password" => " "
    ],
    "categories" => [
        "category" => [
            "title" => "Привилегии",
            "default" => true,
            "notify" => "Донат выдаётся на все сервера навсегда",
            "products" => [
			    "name" => [
                    "title" => "SILVER",
                    "price" => 45.00,
                    "image" => "/image/perm/silver.png",
                    "discount" => 20,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu lp user %user% parent add silver", // Пример команды.
                ],
                "name2" => [
                    "title" => "GOLD",
                    "price" => 100.00,
                    "image" => "/image/perm/gold.png",
                    "discount" => 20,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu lp user %user% parent add gold",
                ],
                "name3" => [
                    "title" => "EMERALD",
                    "price" => 200.00,
					"discount" => 20,
                    "image" => "/image/perm/emerald.png",
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu lp user %user% parent add EMERALD",
                ],
				"name4" => [
                    "title" => "DIAMOND",
                    "price" => 300.00,
					"discount" => 20,
                    "image" => "/image/perm/diamond.png",
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu lp user %user% parent add diamond",
                ],
				"name5" => [
                    "title" => "STENDLY",
                    "price" => 400.00,
					"discount" => 20,
                    "image" => "/image/perm/stendly.png",
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu lp user %user% parent add STENDLY",
                ],
				"name6" => [
                    "title" => "LUCKY",
                    "price" => 1440.00,
					"discount" => 20,
                    "image" => "/image/perm/lucky.png",
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu lp user %user% parent add LUCKY",
                ],
				"name7" => [
                    "title" => "HELPER",
                    "price" => 2990.00,
					"discount" => 30,
                    "image" => "/image/perm/helper.png",
                    "withSurcharge" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu lp user %user% parent add helper",
                ]
            ]
        ],
        "category2" => [
            "title" => "Тайники",
            "products" => [
                "exp" => [
                    "title" => "Тайник с опытом",
                    "price" => 29.00,
                    "image" => "/image/cache/cache-exp.png",
                    "discount" => 0,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu acubelets:cubelets give %user% exp %amount%",
                ],
                "donate" => [
                    "title" => "Тайник с донатом",
                    "price" => 79.00,
                    "image" => "/image/cache/cache-priv.png",
					"discount" => 50,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu acubelets:cubelets give %user% donate %amount%",
                ],
				"pets" => [
                    "title" => "Тайник с питомцем",
                    "price" => 40.00,
                    "image" => "/image/cache/cache-pets.png",
					"discount" => 50,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu acubelets:cubelets give %user% pets %amount%",
                ],
				"cub" => [
                    "title" => "Тайник с кубиками",
                    "price" => 40.00,
                    "image" => "/image/cache/cache-cub.png",
					"discount" => 30,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu acubelets:cubelets give %user% cube %amount%",
                ],
				"titul" => [
                    "title" => "Тайник с титулами",
                    "price" => 38.00,
                    "image" => "/image/cache/cache-titul.png",
					"discount" => 45,
                    "amounted" => true,
                    "command" => "rcon acubelets:cubelets give %user% titul %amount%",
                ],
				"gatg" => [
                    "title" => "Тайник с косметикой",
                    "price" => 34.00,
                    "image" => "/image/cache/cache-gatg.png",
					"discount" => 40,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu acubelets:cubelets give %user% gadgets %amount%",
                ],
				"titulgame" => [
                    "title" => "Тайник с Игровыми титулами",
                    "price" => 25.00,
                    "image" => "/image/cache/cache-game.png",
					"discount" => 10,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu acubelets:cubelets give %user% game %amount%",
                ],
				"titulmult" => [
                    "title" => "Тайник с Мульт титулами",
                    "price" => 27.00,
                    "image" => "/image/cache/cache-multcinema.png",
					"discount" => 10,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu acubelets:cubelets give %user% multfilm %amount%",
                ]						
            ]
        ],
	    "category3" => [
            "title" => "Валюта",
            "products" => [
                "Cubik" => [
                    "title" => "Кубики за шт.",
                    "price" => 5.00,
                    "image" => "/image/vault/vault-cub-test.png",
                    "discount" => 0,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu tm add %user% %amount%",
				],
				"Money" => [
                    "title" => "Монетки за шт.",
                    "price" => 1.00,
                    "image" => "/image/vault/vault-money.png",
                    "discount" => 0,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu money give %user% %amount%",
				],
				"Pil" => [
                    "title" => "Пыль за шт.",
                    "price" => 3.00,
                    "image" => "/image/vault/vault-pil.png",
                    "discount" => 0,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25595 DC`8#pqX_Vu gadgetsmenu:dust add %user% %amount%",
                ],
				"Skull" => [
                    "title" => "Черепа за шт.",
                    "price" => 2.00,
                    "image" => "/image/vault/vault-skull.png",
                    "discount" => 0,
                    "amounted" => true,
                    "command" => "rcon 127.0.0.1:25265 DC`8#pqX_Vu te add %user% %amount%",
                ]				
            ]
        ],
		"category4" => [
            "title" => "Разное",
            "products" => [
			    "Saveaccount" => [
                    "title" => "Восстановление аккаунта",
                    "price" => 185.00,
                    "image" => "/image/other/save_account.png",
                    "discount" => 0,
                    "command" => "give %user% %good% %amount%",
				],
                "UnBan" => [
                    "title" => "Разбан аккаунта",
                    "price" => 100.00,
                    "image" => "/image/other/unban.png",
                    "discount" => 0,
                    "command" => "give %user% %good% %amount%",
				],
				"UnMute" => [
                    "title" => "Разбан чата",
                    "price" => 49.00,
                    "image" => "/image/other/unmute.png",
                    "discount" => 0,
                    "command" => "give %user% %good% %amount%",
				]
			]
		]
    ]	
];

/*

    Структура категории:
    'title' - Название
    'default' => true - категория по умолчанию (может быть только у одной категории)
    'notify' - произвольное сообщение, отображается над товарами
    'products' - массив с товарами

    Структура товара:
    'title' - название
    'price' - цена
    'discount' - скидка (можно не указывать)
    'image' - ссылка на картинку товара
    'amounted' => true - можно заказать несколько товаров (необязательное поле)
    'withSurcharge' => true - работает доплата (не работает одновременно с amounted)
    'command' - команда, выполняемая для выдачи услуге. %amount% заменяется на количество, %user% на ник игрока, %group% на название товара


*/
