<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=NAME',
            'username' => 'USERNAME',
            'password' => 'PASSWORD',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.ingenio.com.py',
                'username' => 'sistema@ingenio.com.py',
                'password' => 'iNg987+-*',
                'port' => '465',
                'encryption' => 'ssl',
                'streamOptions' => [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green',
                ],
            ],
        ],
        'formatter' => [
//            'dateFormat' => 'dd/mm/yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'Gs',
//            'locale' => 'es_PY',
        ],
    ],
];