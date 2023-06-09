<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/cbt.php';
$cbt = require __DIR__ . '/cbt.php';
$nemoGuideEtalon = require __DIR__ . '/nemo_guide_etalon.php';
$routes = require __DIR__ . '/routes.php';
$mailer = require __DIR__ . '/mailer.php';

$config = [
    'id' => 'yii2-skeleton',
    'name' => 'Yii2 Skeleton',
    'language' => $_ENV['APP_LANGUAGE'] ?? 'pt_BR',
    'charset' => 'utf-8',
    'timeZone' => $_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'App\Controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => $_ENV['REQUEST_COOKIE_VALIDATION_KEY'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'App\Models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => $mailer,
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
        'cbt' => $cbt,
        'nemoGuideEtalon' => $nemoGuideEtalon,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'ns' => 'App\\Models',
                'queryNs' => 'App\\Models',
                'useTablePrefix' => true,
                'singularize' => true
            ],
        ],
    ];
}

return $config;
