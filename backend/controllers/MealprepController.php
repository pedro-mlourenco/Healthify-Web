<?php

namespace backend\controllers;

use app\models\SalesMeals;
use app\models\Sales;
use app\models\Tables;
use backend\models\Mealingredients;
use dominus77\sweetalert2\Alert;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class MealprepController extends \yii\web\Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['index', 'preparing', 'deliver'],
                            'allow' => true,
                            'roles' => ['admin', 'chef', 'staff'],
                        ],
                        [
                            'actions' => ['logout'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $mealsToPrep = SalesMeals::find()->where(['not', ['state' => 'done']])->all();
        $tables = Tables::find()->all();

        $takeawaySales = SalesMeals::find()->where(['not', ['state' => 'done']])->andWhere(['mesa' => 'takeaway'])->all();


        foreach ($takeawaySales as $takeaway) {
            $takeawayids[] = $takeaway->salesid;
        }

        $takeawayids = array_unique($takeawayids, SORT_NUMERIC);

        $mealIngredients = Mealingredients::find()->all();

        return $this->render('index', [
            'mealsToPrep' => $mealsToPrep,
            'tables' => $tables,
            'mealIngredients' => $mealIngredients,
            'takeawayids' => $takeawayids
        ]);
    }

    public function actionPreparing($mealId)
    {
        $toAlter = SalesMeals::findOne($mealId);
        $toAlter->state = 'preparing';
        $toAlter->save();

        return $this->redirect(['index']);
    }

    public function actionDeliver($mealId)
    {
        $toAlter = SalesMeals::findOne($mealId);
        $toAlter->state = 'done';
        $toAlter->save();

        return $this->redirect(['index']);
    }
}
