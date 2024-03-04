<?php

namespace backend\api\controllers;
use app\api\models\Cart;
use app\models\Meals;
use yii\rest\ActiveController;

class CustomcartController extends ActiveController
{
    public $modelClass = 'app\api\models\cart';

    public function actionFromuser($id)
    {
        $cart = Cart::find()->where(['userprofilesid' => $id])->andWhere(['state'=>'active'])->all();
        if ($cart == null)
            $jsonResponse = '';
        else{
            foreach ($cart as $item){
                $item->state = Meals::nameByID($item->mealsid);
            }
            $jsonResponse = $cart;
        }

        return $jsonResponse;
    }
}