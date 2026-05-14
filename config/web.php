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

    'modules' => [
        // Chỉ bật Gii & Debug khi đang phát triển
        'gii' => YII_ENV_DEV ? [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', 'localhost'],
        ] : [],
        'debug' => YII_ENV_DEV ? [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['127.0.0.1', '::1', 'localhost'],
        ] : [],
    ],

    'components' => [
        'request' => [
            'cookieValidationKey' => 'OM9G_EszYbTzLeeUN50IsKjtzC1TNjBW',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // Tắt CSRF cho API (rất quan trọng)
            'enableCsrfValidation' => false,
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => ['site/login'],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
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

        // ==================== URL MANAGER - ĐÃ TỐI ƯU ====================
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Web Admin
                'department' => 'department/index',
                'employee'   => 'employee/index',
                'site/<action>' => 'site/<action>',

                // REST API
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/employee',
                    'pluralize' => false,
                    'tokens' => ['{id}' => '<id:\d+>'],
                    'extraPatterns' => [
                        'GET'    => 'index',
                        'POST'   => 'create',
                        'PUT'    => 'update',
                        'PATCH'  => 'update',
                        'DELETE' => 'delete',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/department',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET'    => 'index',
                        'POST'   => 'create',
                        'PUT'    => 'update',
                        'DELETE' => 'delete',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/auth',
                    'pluralize' => false,
                ],
            ],
        ],
    ],
    'params' => $params,
];

// ==================== CORS CHO FLUTTER (RẤT QUAN TRỌNG) ====================
$config['components']['corsFilter'] = [
    'class' => \yii\filters\Cors::class,
    'cors' => [
        'Origin' => ['*'],                    // Thay bằng domain Flutter sau nếu cần
        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => true,
    ],
];

return $config;