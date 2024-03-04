<?php

namespace backend\api\controllers;

use app\api\models\MealIngredients;
use app\api\models\Meals;
use backend\api\models\Sales;
use backend\api\models\SalesMeals;
use yii\helpers\Json;
use yii\rest\ActiveController;

class SalesController extends ActiveController
{
    public function actions()//desativa todas as funçoes desnecessarias
    {
        $action = parent::actions();
        unset($action['create']);
        unset($action['update']);
        unset($action['delete']);
        return $action;
    }

    public $modelClass = 'backend\api\models\sales';

    public function actionSold($id)
    {
        $vendas = Sales::findAll(['userprofilesid'=>$id]);

        return $vendas;
    }
}