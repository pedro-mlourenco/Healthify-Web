<?php

namespace backend\api\controllers;

use app\api\models\Reservations;
use Yii;
use yii\helpers\Json;
use yii\rest\ActiveController;

class ReservationsController extends ActiveController
{
    public $modelClass = 'app\api\models\Reservations';

    public function actionReserved($id)
    {
        $reservations = Reservations::findAll(['userprofilesid' => $id]);

        return Json::encode($reservations);
    }

    public function actionNew()
    {
        $jsonPost = Yii::$app->request->post();

        $reservedday = $jsonPost["reservedday"];
        $reservedtime = $jsonPost["reservedtime"];
        $tableid = $jsonPost["tableid"];
        $userprofilesid = $jsonPost["userprofilesid"];

        if (Reservations::find()->where(['userprofilesid' => $userprofilesid])->andWhere(['reservedday' => $reservedday])->exists()) {
            $jsonResponse = array('message' => 'This client already has a reservation today!');

        } else if (Reservations::find()->where(['tableid' => $tableid])->andWhere(['reservedday' => $reservedday])->andWhere(['reservedtime' => $reservedtime])->exists()) {
            $jsonResponse = array('message' => 'This table is already booked!');

        }else{
            $new = new Reservations();
            $new->reservedday = $reservedday;
            $new->reservedtime = $reservedtime;
            $new->tableid = $tableid;
            $new->userprofilesid = $userprofilesid;
            $new->save();
            $jsonResponse = array('success' => true);
        }
        return Json::encode($jsonResponse);
    }
}