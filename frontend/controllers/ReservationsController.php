<?php

namespace frontend\controllers;

use app\models\Reservations;
use app\models\ReservationsSearch;
use frontend\models\Userprofile;
use Yii;
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
    public function actionIndex()
    {
        $userid = Yii::$app->user->identity->getId();
        $userprofileid = Userprofile::find()->select(['id'])->where(['userid' => $userid])->one();
        $profile = Userprofile::find()->where(['userid' =>$userid])->one();

        if ($profile == null){
            Yii::$app->session->setFlash('danger', 'Por favor complete o perfil!');
            return $this->redirect(['userprofile/create']);
        }

        $userid = $userprofileid['id'];

        return $this->render('index', [
            'userid' => $userid,
        ]);
    }

    public function actionActivereserves($userid)
    {
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andWhere(['userprofilesid' => $userid]);
        $dataProvider->query->andFilterCompare ( 'reservedday', date("Y/m/d"), '>=' );

        $this->layout = false;


        return $this->render('reservas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPastreserves($userid)
    {
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andWhere(['userprofilesid' => $userid])->andFilterCompare ( 'reservedday', date("Y/m/d"), '<' );

        $this->layout = false;


        return $this->render('reservas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reservations model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reservations model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate($userid)
    {
        $model = new Reservations();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                if (Reservations::find()->where(['userprofilesid' => $model->userprofilesid])->andWhere(['reservedday' => $model->reservedday])->exists()) {
                    $model->addError('', 'Já tem uma reserva hoje! Limite de 1 por dia!');
                } else if (Reservations::find()->where(['tableid' => $model->tableid])->andWhere(['reservedday' => $model->reservedday])->andWhere(['reservedtime' => $model->reservedtime])->exists()) {
                    $model->addError('', 'Esta mesa já está reservada!');
                } else {
                    $model->save();
                    return $this->redirect(['index', 'userid' => $model->userprofilesid]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'userid' => $userid,
        ]);
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
