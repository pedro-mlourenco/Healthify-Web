<?php
namespace backend\api\controllers;

use yii\rest\ActiveController;
//devolve todas as refeiçoes  inseridas na base de dados

class MealController extends ActiveController
{
    public function actions()//desativa todas as funçoes desnecessarias
    {
        $action= parent::actions();
        unset($action['create']);
        unset($action['update']);
        unset($action['delete']);
        return $action;
    }

    public $modelClass ='app\api\models\Meals';
}