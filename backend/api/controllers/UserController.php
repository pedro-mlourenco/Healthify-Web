<?php

namespace backend\api\controllers;
use app\api\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public function actions()//desativa todas as funçoes desnecessarias
    {
        $action= parent::actions();
        unset($action['create']);
        return $action;
    }

    public $modelClass = 'app\api\models\User';

}