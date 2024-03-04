<?php

namespace backend\controllers;

use app\models\Category;
use app\models\Meals;
use backend\models\MealsSearch;
use dominus77\sweetalert2\Alert;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MealsController implements the CRUD actions for Meals model.
 */
class MealsController extends Controller
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
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['admin', 'chef'],
                        ],
                        [
                            'actions' => ['index', 'category', 'view'],
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
     * Lists all Meals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $count = Meals::countItemsByCategory();//contagem do numero de refeiçoes po categoria
        $names = Category::getCategoryNamesArray();//nome das categorias

        $mealCount = array_combine($names, $count);//combina os arrays num so

        return $this->render('index', [
            'mealCount' => $mealCount,
        ]);
    }

    public function actionCategory($categoryid, $categoryname)
    {
        $searchModel = new MealsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andWhere(['categoryid'=>$categoryid]);
        $dataProvider->pagination = ['pageSize' => 11];

        return $this->render('category', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryid' => $categoryid,
            'categoryname' => $categoryname
        ]);
    }

    /**
     * Displays a single Meals model.
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
     * Creates a new Meals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($categoryid, $categoryname)
    {
        $model = new Meals();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Refeição criada!');
                return $this->redirect(['category', 'categoryid' => $categoryid, 'categoryname' => $categoryname]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'categoryid' =>$categoryid,
            'categoryname' =>$categoryname
        ]);
    }

    /**
     * Updates an existing Meals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Refeição atualizada!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Meals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $categoryid, $categoryname)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Refeição apagada!');
        return $this->redirect(['category', 'categoryid' => $categoryid, 'categoryname' => $categoryname]);
    }

    /**
     * Finds the Meals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $id ID
     * @return Meals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meals::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
