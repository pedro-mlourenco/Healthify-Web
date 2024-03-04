<?php

namespace backend\api\controllers;
use yii\rest\ActiveController;

class CartController extends ActiveController
{
    public $modelClass = 'app\api\models\cart';
}