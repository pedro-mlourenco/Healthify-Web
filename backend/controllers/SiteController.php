<?php

namespace backend\controllers;

use app\models\Category;
use app\models\Reservations;
use app\models\Sales;
use app\models\SalesMeals;
use backend\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $categorias = Category::getCategoriesCount();
        $reservas = Reservations::getReservesTotalCount();
        $reservascont = Reservations::getReservesChartData();

        $allsales = Sales::find()->all();
        $salescount = count($allsales);
        $salesValue = 0;
        foreach ($allsales as $one) {
            $salesValue = $salesValue + $one->getAttribute('paidamount');
        }
        $salesMealsCount = count(SalesMeals::find()->all());

        return $this->render('index', [
            'numCategorias' => $categorias,
            'numReservas' => $reservas,
            'reservasContagem' => $reservascont,
            'vendasContagem' => $salescount,
            'pedidosContagem' => $salesMealsCount,
            'valorVendas' => $salesValue,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
