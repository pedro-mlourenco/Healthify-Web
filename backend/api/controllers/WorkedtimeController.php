<?php

namespace backend\api\controllers;

use backend\api\models\Schedules;
use phpDocumentor\Reflection\Types\Array_;
use yii\helpers\Json;
use yii\rest\ActiveController;
use backend\api\models\Userschedulesregistry;

class WorkedtimeController extends ActiveController
{
    public $modelClass = 'backend\api\models\Schedules';

    //devolve todos os dias trabalhados pelo funcionario
    public function actionWorkedtime($id){
        $workDays = Schedules::findAll(['userprofilesid'=>$id]);

        foreach ($workDays as $day){
           $day->userprofilesid =array('workedtime'=>Userschedulesregistry::findAll(['schedulesid'=> $day->id]));
        }

        return Json::encode($workDays);
    }

    //insere registo de relogio de ponto dpo empregado
    public function actionAttendance($id){
        $horario = Schedules::findOne(['userprofilesid'=>$id]);
        if ($horario==null){
            $ponto = new Schedules();
            $ponto->userprofilesid=$id;
            $ponto->save();

            $horaEntrada = new Userschedulesregistry();
            $horaEntrada->employee_exit=null;
            $horaEntrada->schedulesid= Schedules::findOne(['userprofilesid'=>$id])->id;
            $horaEntrada->save();

        }else if($horario!=null) {
            $registos = Userschedulesregistry::findAll(['schedulesid' => $horario->id]);

            if ($registos != null){
                $contador=0;
                    foreach ($registos as $registo){
                        if ($registo->employee_exit==null){
                            $registo->employee_exit = date_create('now')->format('Y-m-d H:i:s');
                            $registo->save();
                            $contador++;
                        }
                    }
                    if ($contador==0){
                        $ponto = new Schedules();
                        $ponto->userprofilesid=$id;
                        $ponto->save();

                        $horaEntrada = new Userschedulesregistry();
                        $horaEntrada->employee_exit = null;
                        $horaEntrada->schedulesid = Schedules::findOne(['userprofilesid' => $id])->id;
                        $horaEntrada->save();
                    }

            }else{
                $horaEntrada = new Userschedulesregistry();
                $horaEntrada->employee_exit = null;
                $horaEntrada->schedulesid = Schedules::findOne(['userprofilesid' => $id])->id;
                $horaEntrada->save();

            }
        }
        return Json::encode(array('success'=>true,'status'=>'submited'));
    }
}