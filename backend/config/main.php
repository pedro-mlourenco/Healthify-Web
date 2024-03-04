<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],

    //registo da api na framework
    'modules' => [
        'api' => [
            'class' => 'backend\api\REstAPI',
        ],

        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
    //registo do parser Json
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                //rotas usadas pelo js do site

                ['class' => '\yii\rest\UrlRule', 'controller' => 'mealprep', 'pluralize' => false,
                    'extraPatterns' => [
                        'POST index' => 'index',
                        'POST prep/{mealState}&{mealId}' => 'prep',
                        'POST done/{mealState}&{mealId}' => 'done',
                    ],
                    'tokens' => [
                        '{mealState}' => '<mealState:\\w+>',
                        '{mealId}' => '<mealId:\\d+>',
                    ],
                ],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'mealplanner', 'pluralize' => false,
                    'extraPatterns' => ['POST add/{ingredientsIDs}&{mealId}' => 'add',],
                    'tokens' => [
                        '{ingredientsIDs}' => '<ingredientsIDs:\\d+>',
                        '{mealId}' => '<mealId:\\d+>',
                    ],
                ],

//rotas usadas na api
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/user', 'pluralize' => false],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/profile', 'pluralize' => false],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/empsales', 'pluralize' => false],

                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/review', 'pluralize' => false,
                    'extraPatterns' => [
                        'GET fromuser/{id}' => 'fromuser',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{mealsid}' => '<mealsid:\\d+>',
                        '{review}' => '<review:\\w+>',
                        '{rating}' => '<rating:\\d+>',
                    ],
                ],

                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/payment', 'pluralize' => false,
                    'extraPatterns' => [
                        'POST {id}/pay/{card}' => 'pay',
                        'POST cash/{id}' => 'cash',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{card}' => '<card:\\d+>',
                    ],
                ],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/workedtime', 'pluralize' => false,
                    'extraPatterns' => ['GET workedtime/{id}' => 'workedtime',
                        'POST attendance/{id}' => 'attendance'],
                ],

                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/meal', 'pluralize' => false],


                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/reservations', 'pluralize' => false,
                    'extraPatterns' => [
                        'GET reserved/{id}' => 'reserved',
                        ],
                ],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/cart', 'pluralize' => false],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/customcart', 'pluralize' => false,
                    'extraPatterns' => [
                        'GET fromuser/{id}' => 'fromuser',
                        ],
                    ],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/sales', 'pluralize' => false],

                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/tables', 'pluralize' => false,
                    'extraPatterns' => [
                        'POST ocupar/{tableid}' => 'ocupar',
                        'POST reservar/{tableid}' => 'reservar',
                        'POST libertar/{tableid}' => 'libertar',
                    ],
                    'tokens' => [
                        '{tableid}' => '<tableid:\\d+>',
                    ],
                ],
                ['class' => '\yii\rest\UrlRule', 'controller' => 'api/sales', 'pluralize' => false,
                    'extraPatterns' => [
                        'GET sold/{id}/' => 'sold',
                    ],
                ],
            ],
        ],


        'user' => [
            'identityClass' => 'common\models\User',
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

    ],
    'params' => $params,
];
