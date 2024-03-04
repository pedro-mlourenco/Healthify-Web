<?php

namespace backend\api\controllers;

use backend\api\models\Reviews;
use backend\api\phpMQTT;
use yii\helpers\Json;
use yii\rest\ActiveController;

class ReviewController extends ActiveController
{
    public $modelClass = 'backend\api\models\Reviews';

    public function actionFromuser($id)
    {
        $reviews = Reviews::find()->where(['userprofilesid' => $id])->all();
        if ($reviews == null){
            $jsonResponse = 'Sem Reviews';
        }
        else{
            $jsonResponse = $reviews;
        }
       return $jsonResponse;
    }
}