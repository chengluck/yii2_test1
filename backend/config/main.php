<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\UserBackendModel',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'rules' => [
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
            ],
        ],
       'assetManager' => [
                'bundles' => [
                    'dmstr\web\AdminLteAsset' => [
                        'skin' => 'skin-red',
                    ],
                ],
                'appendTimestamp' => true,
       ],
        //authManager有PhpManager和DbManager两种方法,
        //PhpManager将权限关系保存在文件里,这里使用的是DbManager方式,将权限关系保存在数据库
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        /*
        'view' => [
            'theme' => [
                //'basePath' => '@app/themes/spring',
                //'baseUrl' => '@web/themes/spring',
                'pathMap' => [
                    '@app/views' => [
                        '@app/themes/spring',
                        '@app/themes/christmas'
                    ],
                ],
            ],
        ],
        */
    ],
    /*
    'as theme' => [
        'class' => 'backend\components\ThemeControl',
    ],
    */
    'params' => $params,
    'aliases' => [
        '@mdm/admin' => '@vendor/yii2-admin',
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action,不受权限控制
            //controller/action
            "*",
        ],
    ],
];
