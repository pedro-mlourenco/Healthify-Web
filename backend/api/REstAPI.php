<?php

namespace backend\api;

use Yii;

/**
 * Module module definition class
 */
class REstAPI extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$app->user->enableSession = false;
    }
}
