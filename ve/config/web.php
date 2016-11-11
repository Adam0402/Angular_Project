<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'UTC',
    'vendorPath' => __DIR__ . '/../../new/vendor/',
    'components' => [

        'formatter' => [
            'class' => 'app\helper\format',
            'dateFormat' => 'php:m/d/y',
            'datetimeFormat' => 'php:m/d/y g:i a',
            'timeFormat' => 'php:H:i:s',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'FJSgUA-SwrVzut8jNRLS7nmSNRRyNHs1',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 60*60*24*14,
            'enableSession' => true,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'timeout' => 60*60*24*14,
            'sessionTable' => 'YiiSession',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD', //GD or Imagick
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'plugins' => [
                    [
                        'class' => 'Swift_Plugins_LoggerPlugin',
                        'constructArgs' => [new Swift_Plugins_Loggers_ArrayLogger],
                    ],
                ],
                'host' => 'landexcorp.com',
                'username' => 'steve@landexcorp.com',
                'password' => 'PWh45dfqE0',
                'port' => '587',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                [
                    'pattern' => 'page/<pg>',
                    'route' => 'site/index',
                ],
                [
                    'pattern' => 've2/<pg:\w+>',
                    'route' => 've/index',
                    'defaults' => ['pg' => 'index'],
                    
                ],
            ]
        ],
        'Yii2Twilio' => [
            'class' => 'filipajdacic\yiitwilio\YiiTwilio',
            'account_sid' => 'AC13dfa5cbef380527c08343c4e31de253',
            'auth_key' => 'acde6f94bd36382545b090f05e6cb1e3',
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'v1' => [
            'class' => 'app\api\modules\v1\Module',
        ],
    ],
    'on beforeRequest' => function ()
{
$pathInfo = Yii::$app->request->pathInfo;
$query = Yii::$app->request->queryString;
if (!empty($pathInfo) && substr($pathInfo, -1) === '/')
{
    $url = '/' . substr($pathInfo, 0, -1);
    if ($query)
    {
        $url .= '?' . $query;
    }
    Yii::$app->response->redirect($url, 301);
    Yii::$app->end();
}
},
    'params' => $params,
];
define(YII_ENV_DEV, true);
if (YII_ENV_DEV)
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1',],
    ];
}

return $config;
