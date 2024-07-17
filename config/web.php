<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'ru',
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'request' => [
            'baseUrl' => '',
            'scriptUrl' => '/index.php',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bBkVYEgrfWRqnznMrUZpgEvIXNZ9GPIN',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                
                'catalog/' => 'site/catalog',

                'catalog/brands/' => 'site/brands',
                'catalog/brands/<name:[\w-]+>/' => 'site/brand',

                'catalog/<cat_1:[\w-]+>/' => 'site/category1',
                'catalog/<cat_1:[\w-]+>/<cat_2:[\w-]+>/' => 'site/category2',
                'catalog/<cat_1:[\w-]+>/<cat_2:[\w-]+>/<cat_3:[\w-]+>/' => 'site/category2',
                
                'catalog/<cat_1:[\w-]+>/<cat_2:[\w-]+>/<good_id:\d+>/' => 'site/good',
                'catalog/<cat_1:[\w-]+>/<cat_2:[\w-]+>/<good_id:\d+>/<good_name:[\w-]+>' => 'site/good',

                'search/' => 'site/search',

                'cart/' => 'site/cart',
                'checkout/' => 'site/checkout',

                // 'profile/' => 'site/profile',
                // 'new-password/<key:[\w-]+>' => 'site/new_password',
                // 'profile/orders/' => 'site/orders',
                // 'profile/orders/<order_id:\d+>/' => 'site/order',
                // 'profile/favorites' => 'site/favorites',
                
                'actions/' => 'site/actions',
                'actions/<action_id:\d+>/' => 'site/action',
                'actions/<action_id:\d+>/<name:[\w-]+>/' => 'site/action',

                
                'info/' => 'site/info',
                'info/<name:[\w-]+>/' => 'site/info',
                
                'app/' => 'site/app',
                'contacts/' => 'site/contacts',
                'franchise/' => 'site/franchise',
            ]
        ]
    ],
    'as beforeRequest' => [
        'class' => 'app\components\HtmlCompressor',
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
