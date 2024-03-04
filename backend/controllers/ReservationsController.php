<?php

namespace backend\controllers;

use app\models\Reservations;
use app\models\ReservationsSearch;
use dominus77\sweetalert2\Alert;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservationsController implements the CRUD actions for Reservations model.
 */
class ReservationsController extends Controller
{
    /**
     * @inheritDoc
     */
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
                            'actions' => ['activereserves', 'futurereserves', 'pastreserves', 'view', 'create', 'update', 'delete'],
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

    /**
     * Lists all Reservations models.
     * @return mixed
     */

    public function actionActivereserves($title, $action)
    {
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->Where(['reservedday' => date("Y/m/d")]);

        return $this->render('reserves', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'action' => $action,
            'title' => $title,
        ]);
    }

    public function actionPastreserves($title, $action)
    {
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andFilterCompare ( 'reservedday', date("Y/m/d"), '<' );

        return $this->render('reserves', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'action' => $action,
            'title' => $title,
        ]);
    }

    public function actionFuturereserves($title, $action)
    {
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andFilterCompare ( 'reservedday', date("Y/m/d"), '>' );

        return $this->render('reserves', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'action' => $action,
            'title' => $title,
        ]);
    }

    /**
     * Displays a single Reservations model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $action, $title)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'action' => $action,
            'title' => $title,
        ]);
    }

    /**
     * Creates a new Reservations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($action, $title)
    {
        $model = new Reservations();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                if (Reservations::find()->where(['userprofilesid' => $model->userprofilesid])->andWhere(['reservedday' => $model->reservedday])->exists()) {
                    $model->addError('', 'This client already has a reservation today!');
                } else if (Reservations::find()->where(['tableid' => $model->tableid])->andWhere(['reservedday' => $model->reservedday])->andWhere(['reservedtime' => $model->reservedtime])->exists()) {
                    $model->addError('', 'This table is already booked!');
                } else {
                    $model->save();
                    Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Reserva Criada!');
                    return $this->redirect(['view', 'id' => $model->id, 'action' => $action, 'title' => $title]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'action' => $action,
            'title' => $title,
        ]);
    }

    /**
     * Updates an existing Reservations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $action, $title)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Reserva Atualizada!');
            return $this->redirect(['view', 'id' => $model->id, 'action' => $action, 'title' => $title]);
        }

        return $this->render('update', [
            'model' => $model,
            'action' => $action,
            'title' => $title,
        ]);
    }

    /**
     * Deletes an existing Reservations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $action, $title)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Reserva Apagada!');
        return $this->redirect([$action, 'action' => $action, 'title' => $title]);
    }

    /**
     * Finds the Reservations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Reservations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
