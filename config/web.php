<?php
$params    =   require(__DIR__ . '/params.php');
$db        =   require(__DIR__ . '/db.php');
$aliases   =   require(__DIR__ . '/aliases.php');
$rules     =   require(__DIR__ . '/rules.php');

$config = [
    'id'         =>    'rest-api',
    'name'     =>  'Rest API',
    'basePath'   =>    dirname(__DIR__),
    'bootstrap'  =>    ['log'],
    'timeZone'   =>    'Africa/Nairobi',
    'aliases'    =>    $aliases,
    'controllerNamespace' => 'controllers',
    'modules'  => [
        'v1'   => [
            'basePath' =>   '@modules',
            'class'    =>   'modules\main\v1',
        ],
    ],

    'components'  => [
        'request' => [
            'cookieValidationKey' => 'BVWfyckvqYTzdr6YQcluvhXWLxAcGpwr',
            /* Enable JSON Input: */
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response'    => [
            /* Enable JSON Output: */
            'class'   =>  'yii\web\Response',
            'format'  =>  \yii\web\Response::FORMAT_JSON,
            'charset' =>  'UTF-8',
            'on beforeSend' => function ($event) {
                $response   =  $event->sender;
                if ($response->data !== null && is_array($response->data)) {
                    /* delete code param */
                    if (array_key_exists('code', $response->data)) {
                        unset($response->data['code']);
                    }

                    /* change status to statusCode */
                    if (array_key_exists('status', $response->data)) {
                        $response->data['statusCode'] = $response->data['status'];
                        unset($response->data['status']);
                    }
                }
            },
        ],
        'cache'  => [
            'class'  => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass'   =>  'models\User',
            'enableAutoLogin' =>  false,
            'enableSession'   =>  false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'transport' => [
                      'class' => 'Swift_SmtpTransport',
                      'host' => 'smtp.gmail.com',
                      'username' => 'mevismales@tum.ac.ke',
                      'password' => "0742382201",
                      'port' => '587',
                      'encryption' => 'tls',
                  ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  =>  'yii\log\FileTarget',
                    'levels' =>  ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl'     =>   true,
            'enableStrictParsing' =>   true,
            'showScriptName'      =>   false,
            'rules' => [
                ''     => 'site/index',
                'docs' => 'site/docs',
                [
                    'pattern' => 'resource',
                    'route'   => 'site/resource',
                    // 'suffix'  => '.json'
                ],
                [
                    'class'          =>   'yii\rest\UrlRule',
                    'pluralize'      =>    false,
                    'controller'     =>    ['v1'],
                    'extraPatterns'  =>    $rules,
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    /* configuration adjustments for 'dev' environment */
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        /* uncomment the following to add your IP if you are not connecting from localhost. */
        /* 'allowedIPs' => ['127.0.0.1', '::1'], */
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        /* uncomment the following to add your IP if you are not connecting from localhost. */
        /* 'allowedIPs' => ['127.0.0.1', '::1'], */
    ];
}

return $config;
